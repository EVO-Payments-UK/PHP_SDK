<?php

require_once __DIR__ . '/IpgBaseTest.php';

class AvailablePaymentSolutionTest extends IpgBaseTest
{
    public function testAuthSuccess()
    {

        $tokenize = $this->payments->availablepaymentsolution();
        $tokenize->allowOriginUrl(parent::$FAKE_HOST)->
                    brandId(parent::$BRAND_ID) ->
                    country(parent::$COUNTRY) ->
                    currency(parent::$CURRENCY)
                    ;
        $result = $tokenize->execute();

        parent::logResult($result);
        
        $this->assertEquals("Payments\ResponseSuccess", get_class($result));

    }

}
?>