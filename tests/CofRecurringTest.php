<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

/**
 * Demo for recurring payment
 * 
 *
 */
class CofRecurringTest  extends IpgBaseTest
{
    
    public function testRecurring()
    {
        
        // replace the below variable using the very FIRST payment of YOUR TEST CARD NUMBER.
        // currently, it's of parent::$CARD_NUMBER
        $originalMerchantTxId = 'Yc5XmukxwvFuOKPR8mFf';
        
        
        /********************************************
         * uncomment the below section for running unit test  *
         ********************************************/ 
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
        customerId($sessionToken->customerId)->
        /*
         *
         * these are mandatory for repeat transctions
         *
         * */
        cardOnFileType('Repeat')->
        cardOnFileInitialTransactionId ($originalMerchantTxId)->
        cardOnFileInitiator('Merchant');
        $result = $tokenize->execute();
        parent::logResult($result);
        var_dump($result);
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
        
    }
    
}
?>