<?php

namespace Payments;

class RequestActionCapture extends RequestAction {
	
	protected $_params = array(
        "merchantId" => array("type" => "mandatory"),
        "token" => array("type" => "mandatory"),
    );

}
