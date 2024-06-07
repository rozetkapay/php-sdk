<?php

require_once __dir__.'/config.php';
_log_("callbacks", "===================================");
_log_("callbacks", getallheaders());
//Creates an endpoint for Payment
$rpay = new \RozetkaPay\Api\Payment();

/**  @var \RozetkaPay\Model\Payment\Responses $result */
/**  @var \RozetkaPay\Model\ResponsesError $error */
list($result, $error) = $rpay->callbacks();

_log_("callbacks", $result);

if($result !== false){
    
    file_put_contents(DIR_LOG . $result->external_id, $result->details->status);
    if($result->details->status == "success"){
        //Here you write your code that will do something after payment is success
        
    }elseif($result->details->status == "failure"){
        //Here you write your code that will do something after a payment failure
        $_SESSION['status_rpay'] = "failure";
    }
    
}else{
    _log_("callbacks", $rpay->getHeaderSignature());
    _log_("callbacks", file_get_contents('php://input'));
    
    file_put_contents(__dir__.'/log/callbacks.log', "===================================" .PHP_EOL ,FILE_APPEND);
    file_put_contents(__dir__.'/log/callbacks.log', $rpay->getSignature(file_get_contents('php://input')) .PHP_EOL ,FILE_APPEND);
    file_put_contents(__dir__.'/log/callbacks.log', "===================================" .PHP_EOL ,FILE_APPEND);
    file_put_contents(__dir__.'/log/callbacks_error.log', "===================================" .PHP_EOL ,FILE_APPEND);
    file_put_contents(__dir__.'/log/callbacks_error.log', json_encode($error, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT),FILE_APPEND);
}
_log_("callbacks", "===================================");