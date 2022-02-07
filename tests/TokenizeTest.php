<?php

require_once __DIR__ . '/IpgBaseTest.php';


class TokenizedTest  extends IpgBaseTest
{
    public function testTokenize()
    {

        $tokenize = $this->payments->tokenize();
        $tokenize->allowOriginUrl(parent::$FAKE_HOST)->
                number(parent::$CARD_NUMBER)->
                nameOnCard("John Doe")->
                expiryMonth("12")->
                expiryYear(parent::$YEAR);
        $result = $tokenize->execute();
        
        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
    }


    public function testTokenizeFailure()
    {

        $tokenize = $this->payments->tokenize();
        $tokenize->allowOriginUrl(parent::$FAKE_HOST)->
                number(parent::$CARD_NUMBER)->
                nameOnCard("John Doe")->
                expiryMonth("12")->
                expiryYear("1028");
        $result = $tokenize->execute();
       
        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseError", get_class($result));
    }
    
}
?>