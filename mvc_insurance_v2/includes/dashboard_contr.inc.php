<?php
declare(strict_types=1);

// SINCE THE DB FOREIGN KEYS HAVE AN ERROR IN IT, THIS IS A WORKAROUND
function get_user_role(array $user){
    switch ($user["role_id"]){
        case "1":
            return "manager";
            break;
        case "2":
            return "agent";
            break;
        case "3":
            return "customer";
            break;
        default:
            break;
    }
}

function get_user_role_permissions(array $user){
    $result = "view_dashboard";

    switch ($user["role_id"]){
        case "1":
            $result = "manage_inventory";
            break;
        case "2":
            break;
        case "3":
            $result = "place_order";
            break;
        default:
            break;
    }
    return $result;
}
