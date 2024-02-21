<?php

namespace RozetkaPay\Model;

class Enum {
    
    static function get($value){
        return $this->{$value};
    }
    
}
