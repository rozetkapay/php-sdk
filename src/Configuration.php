<?php

namespace RozetkaPay;

use RozetkaPay\HttpClient\ClientInterface;

class Configuration {
    
    private static $BasicAuth;
    
    private static $customerAuth;
    
    private static $onBehalfOf;
    
    public static function setDev() {
        //self::$ApiUrl = 'api-epdev.rozetkapay.com';
        self::$BasicAuth = base64_encode("a6a29002-dc68-4918-bc5d-51a6094b14a8:XChz3J8qrr");
        
    }
    
    private static $ApiVersion = '1';
    
    private static $ApiUrl = 'api.rozetkapay.com';
    
    private static $ApiPath = '/api';
    
    private static $callbackUrl = '';
    
    private static $HttpClient = 'HttpCurl';
    
    public static function getCallbackUrl() {
        return self::$callbackUrl;
    }

    public static function getResultUrl() {
        return self::$resultUrl;
    }
    
    private static $resultUrl = '';
    
    public static function setCallbackUrl($callbackUrl) {
        self::$callbackUrl = $callbackUrl;
    }

    public static function setResultUrl($resultUrl) {
        self::$resultUrl = $resultUrl;
    }

    public static function getBasicAuth() {
        return self::$BasicAuth;
    }
    
    public static function setBasicAuth($login, $password) {
        self::$BasicAuth = base64_encode($login . ":" . $password);
    }    
    
    public static function getApiVersion() {
        return self::$ApiVersion;
    }
    
    public static function getApiVersionUrl() {
        return '/v' . self::$ApiVersion;
    }

    public static function setApiVersion($ApiVersion) {
        $versions = ['1'];
        if (!in_array($ApiVersion, $versions)) {
            trigger_error('Undefined version! Available versions: \'1\'', E_USER_NOTICE);
            return self::$ApiVersion = '1';
        }
        return self::$ApiVersion = $ApiVersion;
    }

    public static function getApiUrl() {
        return 'https://' . self::$ApiUrl . self::$ApiPath;
    }

    public static function setApiUrl($ApiUrl) {
        self::$ApiUrl = $ApiUrl;
    }

    public static function getHttpClient() {
        return self::setHttpClient(self::$HttpClient);
    }

    public static function setHttpClient($client) {
        if (is_string($client)) {
            $HttpClient = 'RozetkaPay\\HttpClient\\' . $client;
            if (class_exists($HttpClient)) {
                return self::$HttpClient = new $HttpClient();
            }
        } elseif ($client instanceof ClientInterface) {
            return self::$HttpClient = $client;
        }
        trigger_error('Client Class not found or name set up incorrectly. Available clients: HttpCurl, HttpGuzzle', E_USER_NOTICE);
        $HttpClient = 'RozetkaPay\\HttpClient\\HttpCurl';
        return self::$HttpClient = new $HttpClient();
    }
    
}
