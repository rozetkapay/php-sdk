<?php
require_once __dir__.'/config.php';


//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

$external_id = "500209_65d537d95a357";

/**  @var \RozetkaPay\Model\Payment\ResponsesInfo $result */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($result, $error) = $rpay->info($external_id);

if($result !== false){
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
}else{
    echo '<pre>';
    var_dump($error);
    echo '</pre>';
}

