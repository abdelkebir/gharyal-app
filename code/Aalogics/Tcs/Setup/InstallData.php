<?php
namespace Aalogics\Tcs\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Integration\Model\ConfigBasedIntegrationManager;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Sales\Model\Order\Status;
use \Aalogics\Tcs\Mode\Api\Tcs\Api\Request;
use \Aalogics\Tcs\Helper\Data;

class InstallData implements InstallDataInterface
{
	protected $orderStatus;
	/**
	 * 
	 * @var \Aalogics\Tcs\Mode\Api\Tcs\Api\Request
	 */
	protected $_apiRequest;
	
	protected $_helper;

	/**
	 * @param ConfigBasedIntegrationManager $integrationManager
	 */

	public function __construct(
			Status $orderStatus,
			\Aalogics\Tcs\Model\Api\Tcs\Api\Request $apiRequest,
			\Aalogics\Tcs\Helper\Data $helper
)
	{
		$this->orderStatus = $orderStatus;  
		$this->_apiRequest = $apiRequest;
		$this->_helper = $helper;
	}

	/**
	 * {@inheritdoc}
	 */

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();
		$regions = [
					['country_id' => 'PK', 'code' => 'PK-GB', 'default_name' => 'Gilgit - Baltist'],
					['country_id' => 'PK', 'code' => 'PK-AK', 'default_name' => 'Azad Kashmir'],
					['country_id' => 'PK', 'code' => 'PK-FC', 'default_name' => 'Federally Administered Tribal Areas'],
					['country_id' => 'PK', 'code' => 'PK-BN', 'default_name' => 'Balochistan'],
					['country_id' => 'PK', 'code' => 'PK-KA', 'default_name' => 'Khyber Pakhtunkhwa'],
					['country_id' => 'PK', 'code' => 'PK-PB', 'default_name' => 'Punjab'],
					['country_id' => 'PK', 'code' => 'PK-SH', 'default_name' => 'Sindh'],
					];
		foreach ($regions as $region ) {
			$setup->getConnection()
			->insertArray($setup->getTable('directory_country_region'), ['country_id', 'code', 'default_name'], array($region));
		}
		
		//get cities from TCS
		$cities = $this->_apiRequest->getCities();
		foreach ($cities as $city) {
			$pCity = [];
			$pCity['code'] = $city['cityCode'];
			$pCity['area'] = $city['area'];
			$pCity['default_name'] = $city['cityName'];
			$setup->getConnection()
			->insertArray($setup->getTable('pakistan_cities_tcs'), ['code', 'area', 'default_name'], array($pCity));
			
		}
		
		$setup->endSetup();
	}
}