<?php
spl_autoload_register('autoLoader');

function autoLoader($ClassName){
    return "Classes/" . $ClassName . ".class.php";
}