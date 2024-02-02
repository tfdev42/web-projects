<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();


if (isset($_POST["bt_login"])){
    $user_name = trim($_POST["user_name"]);
    $pwd = trim($_POST["pwd"]);
    $errors = [];

    if (empty($user_name) || empty($pwd)){
        $errors[] = "Fill in all fields!";
    }
    
    
    include "../Classes/Dbh.class.php";
    include "../Classes/UserModel.class.php";
    $userModel = new UserModel();

    if ($userModel->getUserByUserName($user_name) === 'false'){
        $errors[] = "Wrong Username";
    }

    /**
     * PW Hash
     */
    $hashedPwd = $userModel->getHashedPwdByUserName($user_name);
    if (password_verify((string)$pwd, (string) $hashedPwd) === 'false'){        
        $errors[] = "Wrong Password";
    }

    $user = $userModel->getUserByUserName($user_name);

    if (isset($errors) && !empty($errors)){
        $_SESSION['errors'] = $errors;
        $errors = null;
        header("location: ../index.php?view=login");                
        die();
    } else {
        if ($user["user_role"] === 'agent'){
            $_SESSION['user']['role'] = 'agent';
            $_SESSION['user']['id'] = $user["user_id"];
            $_SESSION['user']['name'] = $user["user_name"];
            header("location: ../index.php?view=agent_home");
            exit();
            
        } else {
            $_SESSION['user']['role'] = 'customer';
            $_SESSION['user']['id'] = $user["user_id"];
            $_SESSION['user']['name'] = $user["user_name"];
            $_SESSION['user']['orders'] = [];
            header("location: ../index.php?view=home");
            exit();
        }
    }


}