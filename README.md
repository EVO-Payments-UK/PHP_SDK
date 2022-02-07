# EVO-PHP-SDK
This  library provides integration access to the EVO Gateway.

## Quick Start

EVO Gateway PHP SDK is a small library of PHP code that you can use to quickly integrate with the EVO Gateway system and submit transactions, check their status and more.

This section will give you a very quick introduction as to how you can use it and later in this document you will find more details.

## Before you Begin

Before using the EVO Gateway PHP SDK you should be familiar with the contents of the [API Specification for Merchants](docs/API-Specification.pdf) document as it describes all fields and their meaning within a given payment transaction.

## Setup your Project

EVO Gateway PHP SDK is delivered as a composer(*) package, or dependency, that you should add to your PHP project in order to use it.

Once done - all its code will be available to you under the Payments PHP namespace.

> Composer is a popular dependency management tool and you can find more information about it at https://getcomposer.org/

##Choose an Operation Mode

EVO Gateway SDK lets you choose between two ways of using it:

* __Server-to-Server mode__ - where your PHP code performs all necessary preparations and operations on behalf of the user, but without his or her direct involvement, or
 
* __Browser-to-Server mode__ - where your web page only instructs the client’s browser to connect directly to the Payment Processing servers where everything is settled directly between the two, without further involvement from your PHP code.

Choose the one that is most appropriate for your project.

## Configure

Payments SDK needs to ‘know’ a few things before it can perform any operation - for example - your authentication credentials; which is your merchant number; if you’re only testing your app and you don’t actually want to pay with a real card or if it is running in a production environment, etc.

You need to configure it properly before use. All configuration is done through the Payments/Payments class. The simplest way of using it is to create a new instance of it, choose its operation environment (test or production) and then give it all other details either at once - as an associative array (or any other Iterator object) or one by one. For example:

* __Test Environment__, all configuration parameters set at once:

```php
$payments = (new Payments())->testEnvironment(array(
  ‘merchantId’ => ‘42’, 
  ‘password’ => ‘mypassword’));
```
* __Production Environment__, parameters set one by one:
```php	
$payments = (new Payments())->productionEnvironment()->
  merchantId(‘42’)->
  password(‘mypassword’);
```
You can find more details about setting and getting parameters below.

If you need to change the configuration settings, such as production URLs or anything else, you may follow any of the following two scenarios:

* For permanent changes, edit the lib/PaymentsConfig.php and modify the static variables there, so any use of the library will use them
or
* For temporary change, you can set the values of static params of the Config class.

For example
```php
Config::$ProductionUrls["SessionTokenRequestUrl"] = Some.url;
```

Then when you call:

```php
$payments = (new Payments())->productionEnvironment()->
merchantId(‘42’)->
password(‘mypassword’);
```

It will take the newly set SessionTokenRequestUrl.

## Issue Requests

Use the Payments object you just configured to create payment processing requests such as Capture, Purchase, StatusCheck, Refund, etc:
```php
	$newPurchase = $payments->purchase();
```
All request objects inherit from Payments/Executable class and they also have their configuration parameters that you might have to set. You can do it in exactly the same way as with the Payments object. You can either do it in bulk:

```php
$newPurchase = $payments->purchase(array(
  ‘number’ => ‘42’,
  ‘nameOnCard’ => ‘Alice’,
  …)); 
```  
Or one by one:
```php
	$newPurchase = $payments->purchase()->
		number(‘42’)->
		nameOnCard(‘Alice’)->
..<and so on>;
```
Please consult the [API Specification for Merchants](docs/API-Specification.pdf) document for detailed specification of individual fields.

## Execute and Handle Responses

Finally, once you have your request you can execute it by calling its execute() method. You can give it a callback (a PHP callable) that will handle returned data:
```php	
try {
		$myRequest->execute(function($res) {
			// do something with $res
		});
	} catch(Payments/PaymentsException e) {
	// something went wrong, did you configure your request properly?
} 
```
Or you can assign the result to a variable of your choice:
```php
	try {
		$res = $myRequest->execute();
		// do something with $res
	} catch(Payments/PaymentsException e) {
		// something went wrong, did you configure your request properly?
	}
```
More on result data in the [API Specification for Merchants](docs/API-Specification.pdf) document.

## Check out some Examples

You can find various examples, in PHP code, under the _examples/_ folder of the SDK. 

## Payments PHP SDK Reference

In this section you can find more details about the SDK.

## Configuring the SDK and its Request Objects

Objects of the SDK sometimes have their configuration parameters through which you can control the way they operate. There is a general configuration class, called Payments/Payments, that contains parameters common for all other classes and there are parameters that only control individual payments operations that are set on other classes - for example, every payment operation object (or Request Object) will have it’s own parameters too.

Examples of parameters applicable to all objects are API URLs and authentication data. Individual Request parameters can be, for example - the details about a single payment transaction - credit card number and date of expiry, order details, etc. 

Configuration parameters may be __required__, that is - the operation will fail if they have not been set, __conditional__ or __optional__.  

You can find the full list of parameters in the [API Specification for Merchants](docs/API-Specification.pdf) document.

All classes that can be configured are descendants of _Payments/Configurable_ class. 

## How to Configure an Object

Instances of a Payments/Configurable hold a set of parameter -> value mappings that are exposed in three ways - as methods, as properties or as array indexes. The method or property name and array index value determine which parameter is to be used in the given operation. That is, you can access the parameter merchantId of object Payments as:

* __A method call__, like:
```php	
	$myMerchantId = $payments->merchantId(); 
```
which will return the current value of the parameter, and
```php	
	$samePaymentsObject = $payments->password(‘myPassword’);
```
Which will set the value of the parameter, overwriting any previous setting, and return the very same instance of the Payments object so you can continue setting parameters on it, _builders_ style.

* __A property__, like:
```php
	$currentPaymentAmount = $paymentRequest->$amount;
```
Which gives you the parameter’s current value, and
```php
	$paymentRequest->$amount = ‘42.00’;
```
Which sets the value, overwriting any previous setting it might have.

* __An array index__, like:
```php
	$transactionToRefund = $refundRequest[‘originalMerchantTxId’];
```
Gives you the current setting, and
```php
	$refundRequest[‘originalMerchantTxId’] = 42;
```
Sets and overwrites the parameter. 

Sometimes you might have all settings already in another object or array (example when you fetch them from a database or config file) and you might want to set all parameters at once. Instead of iterating them over you can use a bulk set, by:

* __Giving an array or an Iterator object to a constructor__, like:
```php
	$payments = new Payments($myConfigOpts);
	$refundRequest = $payments->refund($myRefundOpts);
```
__Note__: Request Objects are created by calling their respective Payments method, not through a constructor.

* __Calling the object as a function and passing the array or Iterator to it__, like:
```php
	$refundRequest = $payments->refund();
	$refundRequest($myRefundOpts);
```
* __Using some of the special helper methods__, like:
```php
	$payments = new Payments();
	$paymentsTest = $payments->testEnvironment($myConfigOpts);
	$paymentsProduction = $payments->productionEnvironment($myConfigOpts);
```
All methods of setting and getting parameter values are completely interchangeable - you can use any combination of them over a single object and the end result will be exactly the same compared to any other combination you could have used.

Checking if a parameter has already been assigned a value is as simple as using PHP’s own function - _isset(), array_key_exists()_ and so on.

## General Configuration Parameters

General Configuration Parameters are those that you configure on the Payments object and are then applicable to all subsequent Request Objects you obtain from it. Ideally you configure these once, on instantiating the main Payments object and then save the extra code of setting them individually again and again. 

### Note: 
These parameters are not global - if you create one Request Object it will retain the configuration of the Payments object at the instance of creation. Further changes to Payments will not affect an already created Request Object.

### Note: 
The Payments object has two special helper methods that set a predefined list of parameters, depending on your choice of environment - testEnvironment() and productionEnvironment() (See above on how to use them). It is mandatory that you use one or the other, otherwise your configuration will not be complete.

To get the full list of supported parameters and their meaning please consult the [API Specification for Merchants](docs/API-Specification.pdf) document.

## Payments Requests, Results and their Parameters

Every payment operation has its own Request Object. To successfully perform any request one needs to create a related object, configure it and then call its execute() method.

There are 7 Request Object classes in total:

* __Payments/Tokenize__ tokenizes the card for future use.
* __Payments/Auth__ requests authorisation for a payment.
* __Payments/Capture__ performs a capture operation on an authorized payment.
* __Payments/Void__ cancels a previously authenticated payment.
* __Payments/Purchase__ does an authorize and capture operations at once (and cannot be voided).
* __Payments/Refund__ refunds a previous capture operation, partially or in full.
* __Payments/StatusCheck__ returns the status of an already issued payment transaction, as such it doesn’t actually generate a new transaction.

All classes are descendants of _Payments/Request_ class and also inherit settings from the _Payments_ object that created them.

For more information on payment transactions please check the [API Specification for Merchants](docs/API-Specification.pdf) document.

## Typical Request Flows

In your PHP code you will most likely create a Payments object, configure it and use it to create one or more Requests objects. Then you will set parameters to them and call their _execute()_ method to actually submit them to the Payments API. In turn it will pass back data you need to make your app work properly - these can be errors due to misconfiguration,  unexpected conditions, transaction details you’ll need later and etc.

I. Start by creating and configuring a Payments object:
```php
	$payments = (new Payments())->productionEnvironment($myConfigOptions);
```
(See above for more details on configuration parameters).

II. From the newly created object create your request and set some configuration options to it:
```php
	$myAuth = $payments->auth($myAuthOptions);
```	
```php
	$myCapture = $payments->capture($myCaptureOptions);
```
```php
	$myVoid = $payments->void($myVoidOptions);
```
```php
	$myPurchase = $payments->purchase($myPurchaseOptions);
```
```php
	$myRefund = $payments->refund($myRefundOptions);
```
```php
	$myStatusCheck = $payments->statusCheck($myStatusCheckOptions);
```
(See above for other ways of configuring an object and below for individual parameters name of every request)

III. Then issue and either assign the method call result to a variable or provide a PHP callable as a callback 
```php
	try {
		// without a callback
		$myPurchaseResult = $myPurchase->execute();

		// or with a callback
		$myPuchase->execute(function($res) {
			// do something here
		});
} catch(Payments/Exception e) {
	// don’t forget to check for errors!
}
```
IV. Watch for Exceptions

Occasionally the SDK will not be able to perform your request and it will throw an _Exception_. This could be due to misconfiguration or unexpected conditions like no connectivity to the API. Such Exceptions always inherit _Payments/Exception_ so you can distinguish between Payments SDK and other errors of your application code. 

Exceptions are described in more detail in a later section of this document.

V. Handle the API Response

No matter how you issued your request you will be given an instance of the _Payments/Response_ class that holds parameters returned by the Payments API. Furthermore, depending on the success of the operation it might also be an instance of _Payments/Success_, if it was successful, _Payments/Error_ if the API returned an error or _Payments/Info_. You can use the instanceof operator to quickly find out if there was a failure.

Response Objects also inherit the _Payments/Configurable_ class so you can obtain parameters returned by the API in the same way as Request Objects (See above for how this is done). Obviously, as these objects exist only to provide your application with the operation’s results - setting any parameter values on them has no effect.

Every Request will return it’s individual Response parameters. For example - one such parameter that a _Capture_ request will give you is the amount it captured. These parameters are described in the [API Specification for Merchants](docs/API-Specification.pdf) document.

## Payments Errors

Occasionally your payment processing API will not be able to successfully complete a request and it will return an error. Please check out the [API Specification for Merchants](docs/API-Specification.pdf) document to find out more about errors and what causes them to occur.

## Payments Exceptions

In addition to errors found during the processing of a Request exceptions might also be thrown. Here is a list of the Payments PHP SDK Exceptions:
* _Payments/ConfigurationEndpointNotSet_
	Thrown because the API endpoint has not been configured, usually caused because there was no previous call to _testEnvironment()_ or _productionEnvironment()_.
* _Payments/ExecuteNetworkError_
	The SDK could not connect to the API or there was another network connection-related error.
* _Payments/MethodNotFound_
	Thrown when you try to instantiate a Request Object for a Payments request that doesn’t exist.
* _Payments/ParamNotSet_
	Thrown when a mandatory parameter has not been set.
* _Payments/ProcessDataNotSet_
	Caused by using an unconfigured object.

All these classes inherit from a base Payments/Exception class so that you can easily separate them in a try-catch block.

## Advanced Usage Scenarios

This section contains a few suggestions and ideas you might find helpful in saving work or keeping your application code cleaner.

You shouldn’t treat them as the proper way of using the Payments PHP SDK as they’re nothing more than suggestions.

## General vs Individual Configuration Parameters

Payments PHP SDK and its _Configurable_ objects are quite flexible in allowing the setting of parameters. There are hardly any limits on where you can set a given parameter. For this reason, use the _Payments_ object to set those parameters that will be shared among subsequent requests - like merchant ids, passwords or just about anything else.

It might keep your code shorter and simpler.

## Use the Objects of your Application

It’s often the case that your application might already be using other classes and objects - database result objects like _mysqli_result_ or perhaps business-logic objects like Orders, Products, Merchants, etc.

If these implement any of the iterator-like PHP interfaces, like it is the case of mysqli_result then you can use them to directly configure Payments PHP SDK, as it will accept them in a bulk set operation.

In a similar way - when you _execute()_ a request you pass in a callback where the result will be handled and this callback might just as well be a method within a Payment-like object you already developed. This way your business logic won’t be spread among various source files.

## Use Builders pattern to write less

The Builders pattern is a common way of dealing with objects that need long sequences of method calls before they’re usable, exactly the case of configuring Payments PHP SDK objects. If you have chosen method calls, then just ‘chain’ them one after the other, parameter-setting methods always return _$this_:
```php
$myObject = $myObject->
myParamA(‘valueA’)->
myParamB(‘valueB’)->
myParamC(‘valueC’)->
myParamD(‘valueD’)->
… and so on for as long as you like … ;
```
