<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

class CaptureTest  extends IpgBaseTest
{
   


    public function testCaptureSuccess()
    {
        echo PHP_EOL;
        echo PHP_EOL;
        echo '***********************Instruction for running CaptureTest.php *****************************************', PHP_EOL;
        echo '**** Refer to [How to run CAPTURE testcase?] in HowTo.txt file ', PHP_EOL;
        echo '********************************************************************************************************', PHP_EOL;

		$originalMerchantTxId = "KtE15LPs6xyJrIOAECo2";
		
		/********************************************
		 * uncomment the below section for running unit test  *
		 ********************************************/ 
// 		$captureAction = $this->payments->capture();
// 		$captureAction -> allowOriginUrl("http://google.com/") ->
//                        amount(parent::$AMOUNT) ->
// 				       originalMerchantTxId($originalMerchantTxId);       		
// 		$result = $captureAction->execute();
//         parent::logResult($result);
//         $this->assertEquals("Payments\ResponseSuccess", get_class($result));
//         $this->assertEquals("success", $result->result);
    }

  
}
?>