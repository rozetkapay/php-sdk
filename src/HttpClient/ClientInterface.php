<?php

namespace RozetkaPay\HttpClient;

interface ClientInterface {
    
    public function request($method, $url, $headers, $data);
}
