<?php

spl_autoload_register("autoload");

function autoload($className) {
    // $currentDir = dirname(__DIR__);

    // /**
    //  * Returns false if the needle was not found. 
    //  *  */ 
    // if (str_contains($currentDir, "inc") === true) {
    //     $prefix = "../Classes/";
    // } else {
    //     $prefix = "./Classes/";
    // }

    // $suffix = ".class.php";
    // include_once $prefix . $className . $suffix;
    // $prefix = "../Classes/";
    // $suffix = ".class.php";
    // include_once $prefix . $className . $suffix;

    // // Determine the directory path based on the location of the calling script
    // $currentScriptDir = dirname(__FILE__);
    // if (strpos($currentScriptDir, 'inc') !== false) {
    //     // Autoloader is called from the inc/ folder
    //     $prefix = "../Classes/";
    // } else {
    //     // Autoloader is called from the root folder
    //     $prefix = "Classes/";
    // }

    // // Include the class file
    // $suffix = ".class.php";
    // include_once $prefix . $className . $suffix;

    // Determine the directory path based on the location of the calling script
    $currentScriptDir = dirname(__FILE__);
    if (strpos($currentScriptDir, 'inc') !== false) {
        // Autoloader is called from the inc/ folder
        $prefix = dirname(dirname(__FILE__)) . "/Classes/";
    } else {
        // Autoloader is called from the root folder
        $prefix = "Classes/";
    }

    // Include the class file
    $suffix = ".class.php";
    include_once $prefix . $className . $suffix;
}