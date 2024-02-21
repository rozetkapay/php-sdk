<?php
require_once __dir__.'/config.php';


//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

$dataRequest = new \RozetkaPay\Model\Payment\RequestRefund();

$dataRequest->external_id = "500209_65d537d95a357";
$dataRequest->amount = 5;

/**  @var \RozetkaPay\Model\Payment\Responses $result */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($result, $error) = $rpay->refund($dataRequest);


if($result !== false){
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
}else{
    echo '<pre>';
    var_dump($error);
    echo '</pre>';
}

