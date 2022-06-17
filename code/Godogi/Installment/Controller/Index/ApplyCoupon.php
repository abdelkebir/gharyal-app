<?php
namespace Godogi\Installment\Controller\Index;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory; 
use Godogi\Installment\Model\RequestFactory;

class ApplyCoupon extends \Magento\Framework\App\Action\Action
{
    protected $jsonHelper;
    protected $coupon;
    protected $saleRule;
    /**
     * Constructor.
     * 
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Magento\SalesRule\Model\Coupon $coupon,
        \Magento\SalesRule\Model\Rule $saleRule)
    {
        parent::__construct($context);
        $this->jsonHelper = $jsonHelper;
        $this->coupon = $coupon;
        $this->saleRule = $saleRule;
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();
        $couponCode = $post['coupon'];
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $response = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $response->setHeader('Content-type', 'text/plain');

        $ruleId =   $this->coupon->loadByCode($couponCode)->getRuleId();
        $discountAmout = false;
        if($ruleId){
            $rule = $this->saleRule->load($ruleId);
            $discountAmout = $rule->getDiscountAmount();
        }
        $data = [];
        if($discountAmout){
            $data['error'] = false;
            $data['discount'] = $discountAmout;
        }else{
            $data['error'] = true;
        }
        $response->setContents(
            $this->jsonHelper->jsonEncode(
                $data
            )
        );
        return $response;
    } 
}