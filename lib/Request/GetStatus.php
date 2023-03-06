<?php

namespace Payments;

class RequestGetStatus extends Request {

    public function __construct($values = array()) {
        parent::__construct();
        $this->_token_request = new RequestTokenGetStatus($values);
        $this->_action_request = new RequestActionGetStatus($values);
    }

}
