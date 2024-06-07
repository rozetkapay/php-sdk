<?php

require_once __dir__.'/config.php';

//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

//Creates an instance with payment data
$dataRequest = new \RozetkaPay\Model\Payment\RequestCreatePay();

$dataRequest->amount = 100;
$dataRequest->external_id = 500209 ."_". uniqid();
echo '<h1>Order id:' .$dataRequest->external_id . '</h1><br>';
$_SESSION['external_id'] = $dataRequest->external_id;

//If you need to transfer the order ID to the return link, you can still do it this way

//\RozetkaPay\Configuration::setResultUrl(
//        \RozetkaPay\Configuration::setResultUrl() . "?external_id=" .$dataRequest->external_id
//    );

//or

//\RozetkaPay\Configuration::setResultUrl('https://localhost:8000/?external_id=' .$dataRequest->external_id);



/**  @var \RozetkaPay\Model\Payment\Responses $result */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($result, $error) = $rpay->create($dataRequest);

if($result !== false){?>

<a target="_blank" href=" <?php echo $result->getCheckoutUrl();?> ">Go pay</a>
<div class="well well-sm">
    card=4242424242424242  exp=any cvv=any  3ds=Yes result=success<br>
    card=5454545454545454  exp=any cvv=any  3ds=Yes result=success<br>
    card=4111111111111111  exp=any cvv=any  3ds=No result=success<br>
    card=4200000000000000  exp=any cvv=any  3ds=Yes result=rejected<br>
    card=5105105105105100  exp=any cvv=any  3ds=Yes result=rejected<br>
    card=4444333322221111  exp=any cvv=any  3ds=No result=rejected<br>
    card=5100000020002000  exp=any cvv=any  3ds=No result=rejected<br>
    card=4000000000000044  exp=any cvv=any  3ds=No result=insufficient-funds<br>
</div>
<?php
}else{
    echo '<pre>';
    var_dump($error);
    echo '</pre>';
}

