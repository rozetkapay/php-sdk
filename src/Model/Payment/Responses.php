<?php

namespace RozetkaPay\Model\Payment;

use RozetkaPay\Model;

class Responses extends Model\Model{
    
    /**
     * 
     * @var Model\UserAction
     */
    public $action;
    
    /**
     * 
     * @var bool
     */
    public $action_required;
    
    /**
     * 
     * @var Model\TransactionDetails
     */
    public $details;
    
    /**
     * 
     * @var string
     */
    public $external_id;
    
    /**
     * 
     * @var string
     */
    public $id;
    
    /**
     * 
     * @var bool
     */
    public $is_success;
    
    /**
     * 
     * @var string
     */
    public $receipt_url;
    
    /**
     * 
     * @var Model\Payment\RequestPaymentMethods
     */
    public $payment_method;
    
    /**
     * 
     * @var Model\Customer
     */
    public $customer;
    
    public function __construct($data = []) {
        
        parent::__construct($data);
        
        if(isset($data['action']) && !empty($data['action'])){            
            $this->action = new Model\UserAction($data['action']);            
        }
        
        if(isset($data['details']) && !empty($data['details'])){            
            $this->details = new Model\TransactionDetails($data['details']);            
        }
        
        if(isset($data['payment_method']) && !empty($data['payment_method'])){            
            $this->payment_method = new Model\Payment\RequestPaymentMethods($data['payment_method']);            
        }
        
        
        if(isset($data['customer']) && !empty($data['customer'])){
            $this->customer = new Model\UserInfo($data['customer']);
        }
        
    }
    
    public function getCheckoutUrl() {
        
        if($this->action !== null && $this->action->type == 'url'){
            return $this->action->value;            
        }
        return '';
    }
        
}
