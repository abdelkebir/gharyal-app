<?php
namespace Aalogics\Tcs\Logger;

use Magento\Framework\Logger\Handler\Base;

class Handler extends Base
{
	/**
	 * @var string
	 */
	protected $fileName = '/var/log/aatcs.log';

	/**
	 * @var int
	 */
	protected $loggerType = Logger::DEBUG;
}