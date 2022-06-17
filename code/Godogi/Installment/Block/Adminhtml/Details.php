<?php
namespace Godogi\Installment\Block\Adminhtml;
use Godogi\Installment\Model\RequestFactory;


class Details extends \Magento\Framework\View\Element\Template
{
    protected $request;
    protected $requestFactory;
    protected $coupon;
    protected $saleRule;
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        RequestFactory $requestFactory,
        \Magento\SalesRule\Model\Coupon $coupon,
        \Magento\SalesRule\Model\Rule $saleRule)
	{
        $this->request = $request;
        $this->requestFactory = $requestFactory;
        $this->coupon = $coupon;
        $this->saleRule = $saleRule;
		parent::__construct($context);
	}

    protected function getRequestId(){
        return $this->request->getParam('in_id');
    }

    public function getRequest(){
        return $this->requestFactory->create()->load($this->getRequestId());
    }

    public function getDiscount($couponCode)
    {
        $ruleId =   $this->coupon->loadByCode($couponCode)->getRuleId();
        $rule = $this->saleRule->load($ruleId);
        return $rule->getDiscountAmount();
    }
}