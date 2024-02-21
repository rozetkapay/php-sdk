<?php

namespace RozetkaPay\Model\Payment;

class RequestUserDetails extends \RozetkaPay\Model\Model{
    
    
    public $address = '';    
    
    
    public $city = '';
    
    
    public $country = '';
    
    
    public $email = '';
    
    
    public $external_id = '';

    
    public $first_name = '';
    
    
    public $last_name = '';
    
    
    public $patronym = '';
    
    
    public $payment_method;
    
    public function __construct($data = []) {
        parent::__construct($data);
        
        if(isset($data['payment_method']) && !empty($data['payment_method'])){            
            $this->payment_method = new \Payment\RozetkaPay\Model\UserAction($data['payment_method']);            
        }
        
    }
    
}
