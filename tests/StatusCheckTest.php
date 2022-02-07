<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

class StatusCheckTest  extends IpgBaseTest
{
   


    public function testStatusSuccess()
    {
        echo PHP_EOL;
        echo PHP_EOL;
        echo '***********************Instruction for running StatusCheckTest.php *****************************************', PHP_EOL;
        echo '**** Refer to [How to run GET_STATUS testcase?] in HowTo.txt file ', PHP_EOL; 
        echo '************************************************************************************************************', PHP_EOL;

		$originalMerchantTxId = "UZB1GwlJCw2kcdjRrS09";
		
		/********************************************
		 * uncomment the below section for running unit test  *
		 ********************************************/ 
// 		$statucCheckAction = $this->payments->status_check();
// 		$statucCheckAction -> allowOriginUrl(parent::$FAKE_HOST) ->
// 				              merchantTxId($originalMerchantTxId);       		
// 		$result = $statucCheckAction->execute();
// 		parent::logResult($result);
//         $this->assertEquals("Payments\ResponseSuccess", get_class($result));
//         $this->assertEquals("success", $result->result);
        

    }

  
}
?>