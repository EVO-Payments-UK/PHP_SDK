<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

/**
 * Demo for the First payment for COF
 * 
 *
 */
class CofFirstTest  extends IpgBaseTest
{
    
    public function testFirst()
    {
        
        $sessionToken =  $this->getCardTokenHelper() ;

        $tokenize = $this->payments->purchase();
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
        //this is mandatory for payment cards method(paymentSolutionId=500), otherwise 'General error found during NVP transaction' occurs.
        customerId($sessionToken->customerId) ->
        /**
         * mandatory for firt COF
         */
        cardOnFileType('First');
        
        $result = $tokenize->execute();
        parent::logResult($result);
        
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
        $this->assertEquals("redirection", $result->result);
        
     
        
    }
    


  
}
?>