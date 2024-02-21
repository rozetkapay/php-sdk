<?php

require_once __dir__.'/config.php';

//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

/**  @var \RozetkaPay\Model\Payment\Responses $result */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($result, $error) = $rpay->callbacks();


if($result !== false){
    //file_put_contents(__dir__.'/log/callbacks.log', "===================================" .PHP_EOL ,FILE_APPEND);
    //file_put_contents(__dir__.'/log/callbacks.log', json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT),FILE_APPEND);
    
    if($result->details->status == "success"){
        //Here you write your code that will do something after payment is success
        
    }elseif($result->details->status == "failure"){
        //Here you write your code that will do something after a payment failure
        
    }
    
}else{
    file_put_contents(__dir__.'/log/callbacks_error.log', "===================================" .PHP_EOL ,FILE_APPEND);
    file_put_contents(__dir__.'/log/callbacks_error.log', json_encode($error, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT),FILE_APPEND);
}
