<?php

namespace RozetkaPay\Model;

class Model {
    public function __construct($data = []) {
        
        foreach ($this as $key => $value) {
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }
        
    }
}
