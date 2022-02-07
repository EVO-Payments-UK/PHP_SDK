<pre>
    <?php
    include_once '../../payments.php';
    include_once '../example_data.php';

    use Payments\Payments;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => $merchantId,
            "password" => $password,
        ));
        $tokenize = $payments->tokenize();
        $tokenize->allowOriginUrl("http://google.com/")->
                number($credit_card_number)->
                nameOnCard($credit_card_name)->
                expiryMonth($credit_card_expiry_month)->
                expiryYear($credit_card_expiry_year);
        $token = $tokenize->execute();
        var_dump($token);
        $auth = $payments->auth();
        $auth->allowOriginUrl("http://google.com/")->
                merchantNotificationUrl("http://google.com/")->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount($amount)->
                country($country)->
                currency($currency)->
                paymentSolutionId($paymentSolutionId)->
                customerId($token->customerId)->
                specinCreditCardToken($token->cardToken)->
                specinCreditCardCVV($credit_card_cvv);
        $result = $auth->execute();
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