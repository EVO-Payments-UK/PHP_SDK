
    <?php
    include '../../payments.php';
	include '../example_data.php';

    use Payments\Payments;

$fresh = $_GET["merchantTxId"];
//echo 'merchantTxId is:'.$fresh;

try {
        $payments = (new Payments())->testEnvironment(array(
            "merchantId" => $merchantId,
            "password" => $password,
        ));
        $status_check = $payments->status_check();
        $status_check->merchantTxId($fresh )->
                allowOriginUrl("http://google.com/");
        $result = $status_check->execute();
        
    } catch (Exception $e) {
        var_dump("Exception");
        var_dump($e->getMessage());
        var_dump($e->getCode());
        var_dump($e->getFile());
        var_dump($e->getLine());
    }
	?>
	
	<!DOCTYPE html>  
    <html><head>  

        </head>  
        <body>
		<h2><center>Payment status check Demo Page</center></h2>
		<h2>merchantTxId is:<?= $fresh ?></h2>
       <h2>Result is:<?= $result->result ?></h2>
       <h2>Status is:<?= $result->status ?></h2>
	    <h4>Response detail is:<?= var_dump($result); ?></h4>
		</body>
		</html>