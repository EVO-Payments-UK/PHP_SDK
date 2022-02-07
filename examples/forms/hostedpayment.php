<pre>
    <?php
    include '../../payments.php';
	include '../example_data.php';
	
    use Payments\Payments;

try {
		$currentFile = basename(__FILE__, '.php').".php";
		$tmp = getSiteDomain(). $_SERVER['REQUEST_URI'];
		$landingUrl = str_replace($currentFile,"result.php",$tmp ) . "?merchantTxId=".$merchantTxId; 
		//print_r($landingUrl);
		
		
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => $merchantId,
            "password" => $password,
        ));
        $purchase = $payments->purchase();
        $purchase->allowOriginUrl(getSiteDomain())->
                merchantNotificationUrl("http://google.com/")->
				merchantLandingPageUrl($landingUrl) ->
				merchantTxId($merchantTxId) ->
                channel(Payments::CHANNEL_ECOM)->
                userDevice(Payments::USER_DEVICE_DESKTOP)->
                amount($amount)->
                country($country)->
                currency($currency)->
                paymentSolutionId("");
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
            <h3>Hosted Payment Page example</h3>  
            <form method="get" action="<?= $purchase->BaseUrl() ?>">
                <label>token:</label><input name="token" value="<?= $token->token ?>"/><br/>  
                <label>merchantId:</label><input name="merchantId" value="<?= $token->merchantId ?>"/><br/>  
                <label>paymentSolutionId:</label><input name="paymentSolutionId" value="<?= $token->paymentSolutionId ?>"/><br/>

                <input type="hidden" name="integrationMode" value="hostedPayPage"/>  


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
