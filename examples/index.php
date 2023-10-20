<?php
include_once '../test/Configuration.php';

$data = false;
$error = false;

/**  @var \RozetkaPay\Model\Payment\Responses $data */
/**  @var \RozetkaPay\Model\ResponsesError $error */

$rpay = new RozetkaPay\Api\Payment();

$route = '';
if (isset($_SERVER['PATH_INFO'])) {
    $route = $_SERVER['PATH_INFO'];
}

if($route == '/pay/creat'){
    
    $dataRequest = new \RozetkaPay\Model\Payment\RequestCreatePay();

    $dataRequest->amount = 100;
    $dataRequest->external_id = time();
    
    $dataRequest->callback_url = \RozetkaPay\Configuration::getCallbackUrl() . 'pay/callback?external_id=' . $dataRequest->external_id;
    $dataRequest->result_url = \RozetkaPay\Configuration::getResultUrl() . 'pay/result?external_id=' . $dataRequest->external_id;
    
    list($data, $error) = $rpay->create($dataRequest);

    if($error === false){
        echo '<a href="'.$data->getCheckoutUrl().'" target="_blank">' . $data->getCheckoutUrl() . '</a>';
    }
}

if($route == '/pay/result' || $route == '/pay/info'){
    
    if(isset($_GET['external_id'])){
        list($data, $error) = $rpay->info($_GET['external_id']);
    }
}

if($route == '/pay/callback'){
    
    list($data, $error) = $rpay->callbacks();
    
    if($error === false){
        file_put_contents(__DIR__. '/log/'.$data->external_id . '.txt', json_encode($data, JSON_PRETTY_PRINT));
    }else{
        file_put_contents(__DIR__. '/log/'.$data->external_id . '_error.txt', json_encode($error, JSON_PRETTY_PRINT));
    }
    
}

echo '<pre>';
var_dump($data);
echo '</pre>';
echo "============================================".PHP_EOL;
echo '<pre>';
var_dump($error);
echo '</pre>';