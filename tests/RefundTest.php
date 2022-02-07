<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

class RefundTest  extends IpgBaseTest
{
   


    public function testRefundSuccess()
    {
        echo PHP_EOL;
        echo PHP_EOL;
        echo '***********************Instruction for running RefundTest.php *****************************************', PHP_EOL;
        echo '**** Refer to [How to run REFUND testcase?] in HowTo.txt file ', PHP_EOL;
        echo '*******************************************************************************************************', PHP_EOL;

		$originalMerchantTxId = "VceuV2ifkyuVoaaIw1wL";
		
		
	
		/********************************************
		 * uncomment the below section for running unit test  *
		 ********************************************/ 
// 		$refundAction = $this->payments->refund();
// 		$refundAction -> allowOriginUrl(parent::$FAKE_HOST) ->
//                        amount(parent::$AMOUNT) ->
// 				       originalMerchantTxId($originalMerchantTxId);       		
// 		$result = $refundAction->execute();
// 		parent::logResult($result);
//         $this->assertEquals("Payments\ResponseSuccess", get_class($result));
//         $this->assertEquals("success", $result->result);
    }

  
}
?>