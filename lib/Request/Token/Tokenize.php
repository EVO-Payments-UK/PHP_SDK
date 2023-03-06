<?php

namespace Payments;

class RequestTokenTokenize extends RequestToken {

    protected $_params = array(
        "merchantId" => array("type" => "mandatory"),
		"password" => array("type" => "mandatory"),
		"action" => array("type" => "mandatory"),
        "timestamp" => array("type" => "mandatory"),
        "allowOriginUrl" => array("type" => "mandatory"),
        "customerId"  => array("type" => "optional"),
		"cardDescription" => array("type" => "optional"),
    );

    public function __construct() {
        parent::__construct();
        $this->_data["action"] = Payments::ACTION_TOKENIZE;
    }

}
