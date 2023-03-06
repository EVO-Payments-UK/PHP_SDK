<?php

namespace Payments;

class RequestTokenRefund extends RequestToken {
	
	protected $_params = array(
		"merchantId" => array("type" => "mandatory"),
		"password" => array("type" => "mandatory"),
		"action" => array("type" => "mandatory"),
		"timestamp" => array("type" => "mandatory"),
		"allowOriginUrl" => array("type" => "mandatory"),
		"originalTxId" => array("type" => "optional"),
		"originalMerchantTxId" => array("type" => "mandatory"),
		"agentId" => array("type" => "optional"),
		"amount" => array("type" => "mandatory"),
		"partialRefundComment" => array("type" => "optional"),
    );

    public function __construct() {
        parent::__construct();
        $this->_data["action"] = Payments::ACTION_REFUND;
    }

}
