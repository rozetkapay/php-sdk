<?php

namespace RozetkaPay\Model;

class ResponsesError extends \RozetkaPay\Model\Model {    
    /**
     * 
     * @var string
     */
    public $code;
    
    /**
     * 
     * @var string
     */    
    public $message;
    
    /**
     * 
     * @var string
     */
    public $param;
    
    /**
     * 
     * @var type
     */
    public $payment_id;
        
    /**
     * 
     * @var \Payment\RozetkaPay\Model\ErrorType
     */
    public $type;
    
    public function __construct($data = []) {
        parent::__construct($data);
        
        if(isset($data['type'])){            
            $this->type = \RozetkaPay\Model\ErrorType::api_error;      
        }
    }
    
}
