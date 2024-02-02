<?php

spl_autoload_register("autoload");

function autoload($className) {
    $currentDir = __DIR__;

    // Check if the autoloader is called from the 'inc' directory
    if (strpos($currentDir, "inc") !== false) {
        $prefix = "../Classes/";
    } else {
        $prefix = "Classes/";
    }

    $suffix = ".class.php";
    include_once $prefix . $className . $suffix;
}