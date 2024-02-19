# RPay PHP-SDK

<p align="center">
  <img width="200" height="200" src="https://rozetkapay.com/wp-content/uploads/2023/07/rozetka-pay.svg">
</p>

## Payment service provider
A payment service provider (PSP) offers shops online services for accepting electronic payments by a variety of payment methods including credit card, bank-based payments such as direct debit, bank transfer, and real-time bank transfer based on online banking. Typically, they use a software as a service model and form a single payment gateway for their clients (merchants) to multiple payment methods. 
[read more](https://en.wikipedia.org/wiki/Payment_service_provider)

## Installation

## Simple Start
```php
require 'vendor/autoload.php';
//test
//\RozetkaPay\Configuration::setDev();

//or 
\RozetkaPay\Configuration::setBasicAuth("a6a29002-dc68-4918-bc5d-51a6094b14a8", 'XChz3J8qrr');

\RozetkaPay\Configuration::setResultUrl('https://localhost:8000/result');
\RozetkaPay\Configuration::setCallbackUrl('https://localhost:8000/callback');

//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

//Creates an instance with payment data
$dataRequest = new \RozetkaPay\Model\Payment\RequestCreatePay();

$dataRequest->amount = 100;
$dataRequest->external_id = 500209;

/**  @var \RozetkaPay\Model\Payment\Responses $data */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($data, $error) = $rpay->create($dataRequest);

if($data !== false){
    print $data->getCheckoutUrl();
}else{
    print_r($error);
}

```
# Api

See [Docs](https://cdn.rozetkapay.com/public-docs/index.html)
## Examples
To check it you can use build-in php server
```cmd
cd ~/examples
php -S localhost:8000
