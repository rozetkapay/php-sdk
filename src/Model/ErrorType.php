<?php

namespace RozetkaPay\Model;

class ErrorType{
    
    const invalid_request_error = 'invalid_request_error';
    const payment_method_error = 'payment_method_error';
    const payment_settings_error = 'payment_settings_error';
    const payment_error = 'payment_error';
    const api_error = 'api_error';
    const customer_error = 'customer_error';
    
    static function set($type) {
        switch ($type) {
            case 'invalid_request_error':
                return self::invalid_request_error;                
                break;
            case 'payment_method_error':
                return self::payment_method_error;                
                break;
            case 'payment_settings_error':
                return self::payment_settings_error;                
                break;
            
            case 'payment_error':
                return self::payment_error;                
                break;
            
            case 'api_error':
                return self::api_error;                
                break;
            
            case 'customer_error':
                return self::customer_error;                
                break;
        }
    }
    
}
