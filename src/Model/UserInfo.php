<?php

namespace RozetkaPay\Model;

use \RozetkaPay\Model\Model;

class UserInfo extends Model {
    
    
    /**
     * 
     * @var string
     */
    public $browser_user_agent = '';
    
    /**
     * 
     * @var string
     */
    public $email = '';
    
    /**
     * 
     * @var string
     */
    public $external_id = '';
    
    /**
     * 
     * @var string
     */
    public $first_name = '';
    
    /**
     * 
     * @var string
     */
    public $ip_address = '';
    
    /**
     * 
     * @var string
     */
    public $last_name = '';
    
    /**
     * 
     * @var string
     */
    public $patronym = '';
    
    /**
     * 
     * @var string
     */
    public $phone = '';
    
}
