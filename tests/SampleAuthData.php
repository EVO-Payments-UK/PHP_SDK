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
class SampleAuthData extends IpgBaseTest
{
    public function testAuthSuccess()
    {

        $sessionToken =  $this->getCardTokenHelper() ;

        $tokenize = $this->payments->auth();
        $tokenize->allowOriginUrl("http://google.com/")->
                brandId(parent::$BRAND_ID) ->
                merchantNotificationUrl("http://www.google.com")->
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
        
        
        $logDataPath = __DIR__ ."/data.txt";
        
        ob_start();
        var_dump($result);
        $stackTrace = ob_get_clean();
        
        file_put_contents($logDataPath, $stackTrace);
        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));
        $this->assertEquals("redirection", $result->result);
    }

}
?>