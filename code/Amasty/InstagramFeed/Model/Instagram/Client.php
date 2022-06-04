<?php

namespace Amasty\InstagramFeed\Model\Instagram;

use Amasty\Base\Model\Serializer;
use Amasty\InstagramFeed\Api\Data\PostInterface;
use Amasty\InstagramFeed\Model\Backend\GetInternalToken;
use Amasty\InstagramFeed\Model\ConfigProvider;
use Amasty\InstagramFeed\Model\Source\MediaType;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Adapter\Curl;
use Magento\Framework\Url;
use Magento\Framework\Url\QueryParamsResolverInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Zend\Escaper\Escaper;
use Zend_Http_Client as HttpClient;

/**
 * Class Client
 * Class implements communication between Magento and Instagram
 */
class Client
{
    // @codingStandardsIgnoreLine
    public const AUTHORIZE_URL_PATH = 'socialconnect/instagram/authorize';
    public const ENDPOINT_URL = 'https://graph.facebook.com/v8.0/';
    public const TOKEN_URL = self::ENDPOINT_URL . 'oauth/access_token';
    public const ACCOUNTS_URL = self::ENDPOINT_URL . 'me/accounts/';
    public const POSTS_URL = 'https://api.instagram.com/v1/users/self/media/recent?';
    public const EMBED_URL = 'https://graph.facebook.com/v9.0/instagram_oembed?';
    public const MAX_POST_COUNT = 20;

    /**
     * @var Url
     */
    private $urlBuilder;

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var ConfigProvider
     */
    private $configProvider;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var QueryParamsResolverInterface
     */
    private $queryParamsResolver;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var GetInternalToken
     */
    private $getInternalToken;

    public function __construct(
        Serializer $serializer,
        ConfigProvider $configProvider,
        Curl $curl,
        Url $urlBuilder,
        StoreManagerInterface $storeManager,
        QueryParamsResolverInterface $queryParamsResolver,
        Escaper $escaper,
        GetInternalToken $getInternalToken,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->curl = $curl;
        $this->configProvider = $configProvider;
        $this->serializer = $serializer;
        $this->storeManager = $storeManager;
        $this->queryParamsResolver = $queryParamsResolver;
        $this->escaper = $escaper;
        $this->logger = $logger;
        $this->getInternalToken = $getInternalToken;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $params
     * @return string
     */
    private function curl($url, $method, $bodyParams = [])
    {
        $this->curl->setConfig(['header' => false]);
        $this->curl->write(
            $method,
            $url,
            '1.1',
            [],
            implode('&', $bodyParams)
        );
        $result = $this->curl->read();
        $this->curl->close();

        return $result;
    }

    /**
     * @param array $params
     * @return string
     */
    private function getQueryString($params)
    {
        $this->queryParamsResolver->addQueryParams($params);
        $query = $this->queryParamsResolver->getQuery();
        $this->queryParamsResolver->unsetData('query');
        $this->queryParamsResolver->unsetData('query_params');

        return $query;
    }

    /**
     * @param $string
     * @return array|bool|float|int|mixed|string|null
     */
    private function unserialize($string)
    {
        try {
            return $this->serializer->unserialize($string);
        } catch (\Exception $exception) {
            $this->logger->error(__('Error with getting content from Instagram API: %1', $string));
            return [];
        }
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->urlBuilder->getUrl('aminstagramfeed/oauth/callback');
    }

    /**
     * @param int $count
     * @param int|null $storeId
     * @return array
     * @throws LocalizedException
     */
    public function loadMediaIds($count = self::MAX_POST_COUNT, $storeId = null)
    {
        $url = self::ENDPOINT_URL . $this->configProvider->getUserId($storeId) . '/media?' . $this->getQueryString(
            [
                'access_token' => $this->configProvider->getAccessToken($storeId),
                'limit' => $count
            ]
        );
        $allMediaIds = $this->loadByUrl($url);
        return array_slice($allMediaIds, 0, $count);
    }

    /**
     * @param $mediaId
     * @param int|null $storeId
     * @return array
     * @throws LocalizedException
     */
    public function loadMediaById($mediaId, $storeId = null)
    {
        return $this->loadByUrl($this->getMediaUrl($mediaId, $storeId));
    }

    /**
     * @param int $count
     * @param int|null $storeId
     * @return array
     * @throws LocalizedException
     */
    public function loadPosts($count, $storeId = null)
    {
        $result = [];
        $mediaCount = 0;
        $mediaIds = $this->loadMediaIds($count, $storeId);

        if (isset($mediaIds['data'])) {
            foreach ($mediaIds['data'] as $meida) {
                if (isset($meida['id'])) {
                    $mediaData = $this->loadMediaById($meida['id'], $storeId);
                    if (isset($mediaData['id']) && $mediaData['media_type'] !== MediaType::VIDEO) {
                        unset($mediaData['id']);

                        // prepare for insert into index table
                        if ($storeId !== null) {
                            $mediaData[PostInterface::STORE_ID] = $storeId;
                        }

                        $mediaData['caption'] = $mediaData['caption'] ?? '';
                        $result[] = $mediaData;
                        $mediaCount++;
                    } else {
                        continue;
                    }
                }

                if ($mediaCount >= $count) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @param string $mediaId
     * @param int|null $storeId
     * @return string
     */
    public function getMediaUrl($mediaId, $storeId = null)
    {
        return self::ENDPOINT_URL . '/' . $mediaId . '?' . $this->getQueryString(
            [
                'access_token' => $this->configProvider->getAccessToken($storeId),
                'fields' => 'ig_id,caption,comments_count,like_count,media_url,media_type,permalink,shortcode,timestamp'
            ]
        );
    }

    /**
     * @param string $url
     *
     * @return array
     */
    protected function loadByUrl($url)
    {
        $result = $this->curl($url, HttpClient::GET);
        $result = $this->unserialize($result);
        $result = $result ?: [];

        if (isset($result['error']['message'])) {
            throw new LocalizedException(__($result['error']['message']));
        }

        return $result;
    }

    /**
     * @param $postUrl
     * @param $maxWidth
     * @param $hideCaption
     * @return string
     */
    public function loadSinglePostHtml($postUrl, $maxWidth, $hideCaption)
    {
        $url = self::EMBED_URL
            . $this->getQueryString([
                'url' => $postUrl,
                'access_token' => $this->configProvider->getAccessToken(),
                'maxwidth' => $maxWidth,
                'hidecaption' =>  $hideCaption
            ]);

        $result = $this->curl($url, HttpClient::GET);

        $result = $this->unserialize($result);
        $result = isset($result['html']) ? $result['html'] : '';

        return $result;
    }

    /**
     * @param string $token
     * @return string|null
     */
    public function getUserIdByToken($token)
    {
        $userId = null;
        $postData = [
            'access_token' => $token
        ];

        $url = self::ACCOUNTS_URL . '?' . http_build_query($postData);
        $result = $this->curl($url, HttpClient::GET);
        $result = $this->unserialize($result);

        if (isset($result['data']) && is_array($result['data'])) {
            foreach ($result['data'] as $account) {
                $postData = [
                    'access_token' => $token,
                    'fields' => 'instagram_business_account'
                ];

                $url = self::ENDPOINT_URL . $account['id'] . '?' . http_build_query($postData);
                $result = $this->curl($url, HttpClient::GET);

                $result = $this->unserialize($result);
                if (isset($result['instagram_business_account']['id'])) {
                    $userId = $result['instagram_business_account']['id'];
                    break;
                }
            }
        }
        return $userId;
    }

    /**
     * @param $storeId
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getAuthorizeUrl($storeId)
    {
        return $this->configProvider->getAuthorizeHost()
            . self::AUTHORIZE_URL_PATH
            . '?'
            . http_build_query(['key' => $this->generateAuthorizationKey($storeId)]);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function getRefererUrl()
    {
        $storeId = $this->storeManager->getDefaultStoreView()->getId();
        return $this->storeManager->getStore($storeId)->getBaseUrl(UrlInterface::URL_TYPE_LINK, true);
    }

    /**
     * @param int $storeId
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function generateAuthorizationKey($storeId)
    {
        $data = [
            'referer' => $this->getRefererUrl(),
            'store_id' => $storeId,
            'internal_token' => $this->getInternalToken->execute()
        ];
        return base64_encode($this->serializer->serialize($data));
    }

    /**
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getIsRefererSecure()
    {
        return strpos($this->getRefererUrl(), 'https') === 0;
    }
}
