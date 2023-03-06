<?php

namespace Payments;

class RequestActionVoid extends RequestAction {
	
	protected $_params = array(
        "merchantId" => array("type" => "mandatory"),
        "token" => array("type" => "mandatory"),
    );
	
}
