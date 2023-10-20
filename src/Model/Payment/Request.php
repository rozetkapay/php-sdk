<?php

namespace RozetkaPay\Model\Payment;

use \RozetkaPay\Model\Model;
use \RozetkaPay\Model\RequestUserDetails;

class Request extends Model{
    
    
    public $external_id = '';
    
    
    public $amount = 0;
    
    
    public $callback_url = '';
    
    
    public $currency = 'UAH';
        
    
    public $payload = '';
    
    
    public $recipient;
    
    public function __construct($data = []) {
        
        parent::__construct($data);
        
        
        if(isset($data['recipient']) && !empty($data['recipient'])){            
            $this->recipient = new RequestUserDetails($data['recipient']);            
        }
        
    }
    
    
    
}
