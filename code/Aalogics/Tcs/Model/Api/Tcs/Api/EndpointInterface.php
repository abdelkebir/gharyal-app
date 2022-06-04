<?php
namespace Aalogics\Tcs\Model\Api\Tcs\Api;

interface EndpointInterface {
	
	public function makeRequestParams($parameters = []);
	
	public function makeRequestHeaders($parameters = []);
}