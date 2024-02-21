<?php
require_once dirname(__dir__).'/autoloader.php';

\RozetkaPay\Configuration::setDev();

$buse_url = "https://juxtaposition.devtool2.fun/rozetkapay-php-sdk/examples/";

\RozetkaPay\Configuration::setResultUrl($buse_url . 'payResult.php');
\RozetkaPay\Configuration::setCallbackUrl($buse_url . 'payCallbacks.php');