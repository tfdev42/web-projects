<?php

spl_autoload_register("autoload");

function autoload($className) {
    $currentDir = dirname(__DIR__);

    /**
     * Returns false if the needle was not found. 
     *  */ 
    if (str_contains($currentDir, "inc") === true) {
        $prefix = "../Classes/";
    } else {
        $prefix = "./Classes/";
    }

    $suffix = ".class.php";
    include_once $prefix . $className . $suffix;
}