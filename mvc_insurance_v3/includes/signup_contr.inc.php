<?php
declare(strict_types=1);

function getPostInputFields() : array | null {
    $post = $_POST;
    $result = [];
    foreach($post as $key => $value){
        // if HTML post is Button -> dont add to array
        if($key === "bt_signup"){
            continue;
        }
        $result[$key] = $value;
    }
    return $result;
}