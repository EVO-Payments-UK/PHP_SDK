<?php

namespace Payments;

class RequestActionAuth extends RequestAction {

	protected $_params = array(
		"merchantId" => array("type" => "mandatory"),
		"token" => array("type" => "mandatory"),
		"freeText" => array("type" => "optional"),
		"fraudToken" => array("type" => "optional"),
		"setOneClickValueSettingForCard" => array("type" => "optional"),
		"specinCreditCardCVV" => array("type" => "optional"),
		"ipPlanId" => array("type" => "optional"),
	);

}