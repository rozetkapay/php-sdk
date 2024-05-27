<?php

namespace RozetkaPay\Model\Payment;

class RequestCreatePay {
    
    
    public $amount = 0;
    
    
    public $callback_url = '';
    
    /**
     * 
     * @var string
     */
    public $result_url = '';
    
    public $confirm = true;
    
    /**
     * 
     * @var string
     */
    public $currency = 'UAH';
    
    /**
     * 
     * @var \RozetkaPay\Model\Payment\Customer
     */
    public $customer;
    
    /**
     * 
     * @var string
     */
    public $description = '';
    
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
    
    public $products;
    
    public $properties;
    
    public $recipient;
    
    /**
     * 
     * @var string
     */
    public $mode = 'hosted'; //direct or hosted    
    
    
}
