<?php
require_once __DIR__ . '/IpgBaseTest.php';

use Payments\Payments;

class VoidTest  extends IpgBaseTest
{
   


    public function testVoidSuccess()
    {
        echo PHP_EOL;
        echo PHP_EOL;
        echo '***********************Instruction for running VoidTest.php *****************************************', PHP_EOL;
        echo '**** Refer to [How to run VOID testcase?] in HowTo.txt file ', PHP_EOL;
        echo '*****************************************************************************************************', PHP_EOL;

		$originalMerchantTxId = "XqgERVBvSVWuvBBwtD2t";
		
		/********************************************
		 * uncomment the below section for running unit test  *
		 ********************************************/ 
// 		$voidAction = $this->payments->void();
// 		$voidAction -> allowOriginUrl(parent::$FAKE_HOST) ->
//                        brandId(parent::$BRAND_ID) ->
//                        merchantNotificationUrl(parent::$FAKE_HOST) ->
// 				       originalMerchantTxId($originalMerchantTxId);       
//         $result = $voidAction->execute();
//         parent::logResult($result);
//         $this->assertEquals("Payments\ResponseSuccess", get_class($result));
//         $this->assertEquals("success", $result->result);
    }

  
}
?>