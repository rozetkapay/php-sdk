<?php

spl_autoload_register(function ($class_name) {

    $classs = explode('\\', $class_name);

    if (current($classs) != 'RozetkaPay')
        return;
    array_shift($classs);
    
    include_once  __DIR__ .'/src/' . (implode('/', $classs)) . '.php';
});
