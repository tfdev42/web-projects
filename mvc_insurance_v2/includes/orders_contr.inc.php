<?php
declare(strict_types=1);

function is_input_empty(string $field){
    
    if( ! isset($field) || empty($field)){
        return true;
    }
    
    return false;
}