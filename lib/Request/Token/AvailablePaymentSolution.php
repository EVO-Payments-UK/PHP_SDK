<?php

namespace Payments;

class RequestTokenAvailablePaymentSolution extends RequestToken {

    protected $_params = array(
        "merchantId" => array("type" => "mandatory"),
        "password" => array("type" => "mandatory"),
        "action" => array("type" => "mandatory",),
		"timestamp" => array("type" => "mandatory"),
		"allowOriginUrl" => array("type" => "mandatory"),
        "currency" => array("type" => "mandatory"),
        "country" => array("type" => "mandatory"),
        "brandId" => array("type" => "optional"),
    );

    public function __construct() {
        parent::__construct();
        $this->_data["action"] = Payments::ACTION_AVAILABLE_PAYMENT_SOLUTION;
    }

}
