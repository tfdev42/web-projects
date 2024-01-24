<?php

spl_autoload_register("autoload");

function autoload($className){
    $currentDir = __DIR__;
    $prefix = "./Classes/";
    $suffix = ".class.php";

    if( ! stripos($currentDir, "includes")){
        $prefix = "../Classes/";
    }
    
    include_once $prefix . $className . $suffix;
    
}