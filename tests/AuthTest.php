<?php
require_once __DIR__ . '/IpgBaseTest.php';
use Payments\Payments;

class AuthTest extends IpgBaseTest
{
    public function testAuthSuccess()
    {


        $sessionToken =  $this->getCardTokenHelper() ;

        $tokenize = $this->payments->auth();
        $tokenize->allowOriginUrl(parent::$FAKE_HOST)->
                brandId(parent::$BRAND_ID) ->
                merchantNotificationUrl(parent::$FAKE_HOST)->
                paymentSolutionId(parent::$PAYMENT_SOLUTION_ID)->
                channel(Payments::CHANNEL_ECOM)->
                amount(parent::$AMOUNT)->
                country(parent::$COUNTRY)->
                currency(parent::$CURRENCY)->
                specinCreditCardCVV('888')->
                specinCreditCardToken($sessionToken->cardToken) ->
                //this must be set properly, otherwise 'General error found during NVP transaction' occurs.
                customerId($sessionToken->customerId)
                ;
        $result = $tokenize->execute();
        
        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
        $this->assertEquals("redirection", $result->result);
        $this->assertEquals("NOT_SET_FOR_CAPTURE", $result->status);
    }
    
    

    public function testPurchaseSuccess()
    {


        $sessionToken =  $this->getCardTokenHelper() ;
        
        $tokenize = $this->payments->purchase();
        $tokenize->allowOriginUrl(parent::$FAKE_HOST)->
                brandId(parent::$BRAND_ID) ->
                merchantNotificationUrl(parent::$FAKE_HOST)->
                paymentSolutionId('500')->
                channel(Payments::CHANNEL_ECOM)->
                amount(parent::$AMOUNT)->
                country(parent::$COUNTRY)->
                currency(parent::$CURRENCY)->
                specinCreditCardCVV('888')->
                specinCreditCardToken($sessionToken->cardToken) ->
                //this must be set properly, otherwise 'General error found during NVP transaction' occurs.
                customerId($sessionToken->customerId)
                ;
        $result = $tokenize->execute();

        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
        $this->assertEquals("redirection", $result->result);
        $this->assertEquals("SET_FOR_CAPTURE", $result->status);
    }
    
  


}
?>