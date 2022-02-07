<pre>
    <?php
    include '../../payments.php';

    use Payments\Payments;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => "5000",
            "password" => "5678",
        ));
        $purchase = $payments->purchase();
        $purchase->allowOriginUrl("http://google.com/")->
                merchantNotificationUrl("http://google.com/")->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount("20.00")->
                country("GB")->
                currency("EUR")->
                paymentSolutionId("500");
        $token = $purchase->token();
        ?>
    </pre>
    <!DOCTYPE html>  
    <html><head>  
            <script type="text/javascript">
                window.onerror = function myErrorHandler(errorMsg, url, lineNumber) {
                    alert("Error occured: " + errorMsg + "\nurl: " + url + "\nline: " + lineNumber);//or any
                    message
                    return false;
                }
            </script>  
            <style>  
                label {  
                    width: 10em;  
                    display: inline­block;  
                    margin: 0 0 0.5em 0;  
                } 
                input {  
                    width: 15em;  
                } 
            </style>
        </head>  
        <body>  
            <h3>Redirection example</h3>  
            <h4>redirectedFullWindow</h4>  
            <form method="get" action="<?= $purchase->BaseUrl() ?>">
                <label>token:</label><input name="token" value="<?= $token->token ?>"/><br/>  
                <label>merchantId:</label><input name="merchantId" value="<?= $token->merchantId ?>"/><br/>  
                <label>paymentSolutionId:</label><input name="paymentSolutionId" value="500"/><br/>

                <input type="hidden" name="integrationMode" value="standalone"/>  


                <button type="submit" >Pay </button>  
            </form>  
        </body>  
    </html>
    <?php
} catch (Exception $e) {
    ?>
    <pre>
        <?php
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
        ?>
    </pre>
    <?php
}
