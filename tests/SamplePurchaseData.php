<?php
require_once __DIR__ . '/IpgBaseTest.php';
use Payments\Payments;

/**
 * This is for preparing data. No real test case.
 * 
 * 
 * @author peter.shang
 *
 */
class SamplePurchaseData extends IpgBaseTest
{
    public function testAuthSuccess()
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
        customerId($sessionToken->customerId)
        ;
        
        $result = $tokenize->execute();
        
        parent::logResult($result);
        
        $logDataPath = __DIR__ ."/purchasedata.txt";
        
        ob_start();
        var_dump($result);
        $stackTrace = ob_get_clean();
        
        file_put_contents($logDataPath, $stackTrace);
        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
    }

}
?>