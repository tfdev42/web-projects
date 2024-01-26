<?php

spl_autoload_register("autoload");

function autoload($className){
    $currentDir = __DIR__;
    $prefix = "./Classes/";
    $suffix = ".class.php";

    if(strpos($currentDir, "includes") !== false){
        $prefix = "../Classes/";
    }

    include_once $prefix . $className . $suffix;
    
}