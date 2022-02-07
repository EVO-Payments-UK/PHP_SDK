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
        $auth = $payments->auth();
        $auth->allowOriginUrl("http://google.com/")->
                merchantNotificationUrl("http://google.com/")->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount($amount)->
                country($country)->
                currency($currency)->
                paymentSolutionId($paymentSolutionId)->
                customerId($customer_it_token)->
                specinCreditCardToken($credit_card_token)->
                specinCreditCardCVV($credit_card_cvv);
        $result = $auth->execute();
        print_r($result);
    } catch (Exception $e) {
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
    }
    ?>
</pre>