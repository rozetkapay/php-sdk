<?php

namespace RozetkaPay\Api;

class Customer extends \RozetkaPay\Api\Api{
    
    protected $url = '/customers';
    
    public function getWallet($external_id) {
        
        $external_id = $this->externalIdToStr($external_id);
        
        return $this->Request('GET', "/wallet", [], ['external_id' => $external_id]);
    }
    
    public function addWallet($external_id) {
        
    }
    
    public function delWallet($external_id) {
        
    }   
}
