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
        $tokenize = $payments->tokenize();
        $tokenize->allowOriginUrl("http://google.com/")->
                number($credit_card_number)->
                nameOnCard($credit_card_name)->
                expiryMonth($credit_card_expiry_month)->
                expiryYear($credit_card_expiry_year);
        $result = $tokenize->execute();
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