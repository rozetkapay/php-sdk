<?php
require_once __dir__.'/config.php';

$external_id = isset($_SESSION['external_id']) ? $_SESSION['external_id'] : false;

$status = "????";
if($external_id !== false){
    
    echo '<h1>Order id:' .$external_id . '</h1><br>';
    
    if(file_exists(DIR_LOG . $external_id)){
        $status = file_get_contents(DIR_LOG . $external_id);
        unlink(DIR_LOG . $external_id);
    }
    
    echo '<h3> status:' .$status . '</h3>';
}