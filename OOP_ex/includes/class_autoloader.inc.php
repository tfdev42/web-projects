<?php
spl_autoload_register('autoLoader');

function autoLoader($ClassName){
    $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];

    if (strpos($url, 'includes')){
        $path = "../Classes/";
    } else {
        $path = "Classes/";
    }
    $extension = ".class.php";
    require_once $path . $ClassName . $extension;    
}