<?php
/**
* @author Amasty Team
* @copyright Copyright (c) 2022 Amasty (https://www.amasty.com)
* @package Amasty_InstagramFeedGraphql
*/


declare(strict_types=1);

namespace Amasty\InstagramFeedGraphql\Model\Resolver;

use Amasty\InstagramFeed\Model\Instagram\Client;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Store\Model\Store;
use Magento\Widget\Model\ResourceModel\Widget\Instance\CollectionFactory;
use Magento\Widget\Model\Widget\Instance;

class Widget implements ResolverInterface
{
    private const INSTANCE_ID = 'instance_id';
    /**
     * @var CollectionFactory
     */
    private $widgetCollectionFactory;

    /**
     * @var Client
     */
    private $client;

    public function __construct(
        CollectionFactory $widgetCollectionFactory,
        Client $client
    ) {
        $this->widgetCollectionFactory = $widgetCollectionFactory;
        $this->client = $client;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws LocalizedException
     * @throws \Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ): array {
        $currentStoreId = (int)$context->getExtensionAttributes()->getStore()->getId();
        $widget = $this->widgetCollectionFactory->create()
            ->addFieldToFilter(self::INSTANCE_ID, $args['widgetId'])
            ->getFirstItem();

        if (!$widget) {
            throw new LocalizedException(__('No widget found with specified id.'));
        }

        $this->validateStore($widget, $currentStoreId);
        $widgetParams = $widget->getWidgetParameters();
        $widgetParams = $this->addHtmlContent($widgetParams);

        return $widgetParams;
    }

    /**
     * @param Instance $widget
     * @param int $storeId
     * @return void
     * @throws LocalizedException
     */
    private function validateStore(Instance $widget, int $storeId): void
    {
        if (!in_array(Store::DEFAULT_STORE_ID, $widget->getStoreIds())
            && !in_array($storeId, $widget->getStoreIds())
        ) {
            throw new LocalizedException(__('Requested widget not available for provided storeId.'));
        }
    }

    private function addHtmlContent(array $widgetParams): array
    {
        if (isset($widgetParams['post_url'])) {
            $widgetParams['html_content'] = $this->client->loadSinglePostHtml(
                $widgetParams['post_url'],
                $widgetParams['max_width'],
                $widgetParams['hide_caption']
            );
        }

        return $widgetParams;
    }
}
