<?php
session_start();
require_once dirname(__dir__).'/autoloader.php';

\RozetkaPay\Configuration::setDev();

$buse_url = "https://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_URL'])."/";

\RozetkaPay\Configuration::setResultUrl($buse_url . 'payResult.php');
\RozetkaPay\Configuration::setCallbackUrl($buse_url . 'payCallbacks.php');

define("DIR_LOG", __dir__.'/log/');

function _log_($type, $var){
    file_put_contents(DIR_LOG.$type.'.log', 
            json_encode($var, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) . PHP_EOL,FILE_APPEND);
}