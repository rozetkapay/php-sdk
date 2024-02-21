<?php

namespace RozetkaPay\Model\Payment;

use RozetkaPay\Model;

class ResponsesInfo extends Model\Model{
    
    //======================= purchased ============================================================
    
    /**
     * 
     * @var float
     */
    public $amount = 0;
    
    
    
    public $purchased;
    
    
    public $purchase_details = array();
    
    //==============================================================================================
    
    //======================= canceled= ============================================================
    
    public $amount_canceled = 0;
    
    
    
    public $canceled;
    
    
    public $cancellation_details = array();
    
    //==============================================================================================
    
    
    public $amount_confirmed = 0;    
    
    
    public $confirmed;
    
    
    public $confirmation_details = array();
    
    //==============================================================================================
    
    
    public $amount_refunded = 0;    
    
    
    public $refunded;
    
    
    public $refund_details = array();
    
    //==============================================================================================
    
    /**
     * 
     * @var Model\UserAction
     */
    public $action;
    
    
    public $action_required;
    
    
    public $currency = "UAH";    
    
    
    public $created_at;
    
    
    public $external_id;
    
    
    public $id;
    
    
    public $receipt_url;
    
    
    public function __construct($data = []) {
        
        parent::__construct($data);
        
        if(isset($data['action']) && !empty($data['action'])){            
            $this->action = new Model\UserAction($data['action']);            
        }
        
        if(isset($data['purchase_details']) && !empty($data['purchase_details'])){
            foreach ((array)$data['purchase_details'] as $detail) {
                $this->purchase_details = [];
                $this->purchase_details[] = new Model\TransactionDetails($detail);      
            }
        }
        
        if(isset($data['confirmation_details']) && !empty($data['confirmation_details'])){
            $this->confirmation_details = [];
            foreach ((array)$data['confirmation_details'] as $detail) {
                $this->confirmation_details[] = new Model\TransactionDetails($detail);      
            }
        }
        
        if(isset($data['cancellation_details']) && !empty($data['cancellation_details'])){
            $this->cancellation_details = [];
            foreach ((array)$data['cancellation_details'] as $detail) {
                $this->cancellation_details[] = new Model\TransactionDetails($detail);      
            }
        }
        
        if(isset($data['refund_details']) && !empty($data['refund_details'])){
            $this->refund_details = [];
            foreach ((array)$data['refund_details'] as $detail) {
                $this->refund_details[] = new Model\TransactionDetails($detail);      
            }
        }
    }
    
}
