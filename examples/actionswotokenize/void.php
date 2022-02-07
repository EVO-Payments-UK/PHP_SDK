<pre>
    <?php
    include_once '../../payments.php';
    include_once '../example_data.php';

    use Payments\Payments;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => "5000",
            "password" => "5678",
        ));
        $void = $payments->void();
        $void->allowOriginUrl("http://google.com/")->
                originalMerchantTxId("OOf0eRUHTJxHaFXXzhX0");
        $result = $void->execute();
        var_dump($result);
    } catch (Exception $e) {
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
    }
    ?>
</pre>