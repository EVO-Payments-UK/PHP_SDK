<?php

namespace Payments;

class RequestActionGetStatus extends RequestAction {

    protected $_params = array(
        "merchantId" => array("type" => "mandatory"),
        "token" => array("type" => "mandatory"),
        "txId" => array("type" => "optional"),
        "merchantTxId" => array("type" => "optional"),
    );

}
