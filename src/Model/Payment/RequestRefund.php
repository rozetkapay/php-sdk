<?php

namespace RozetkaPay\Model\Payment;

class RequestRefund {
    
    
    public $amount = 0;
    
    
    public $callback_url = '';
        
    /**
     * 
     * @var string
     */
    public $currency = 'UAH';
        
    /**
     * 
     * @var string
     */
    public $external_id = '';
    
    /**
     * 
     * @var string
     */
    public $payload = '';
    
    
}
