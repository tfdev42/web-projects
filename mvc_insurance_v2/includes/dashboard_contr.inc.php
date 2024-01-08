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
    $permissions = array(
        "view_dashboard" => true,
        "place_order" => false,
        "manage_inventory" => false
    );

    switch ($user["role_id"]){
        case "1":
            $permissions["manage_inventory"] = true;
            break;
        case "3":
            $permissions["place_order"] = true;
            break;
        default:
            break;
    }
    return $permissions;
}
