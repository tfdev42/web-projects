<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();


if (isset($_POST["bt_signup"])){
    $user_name = trim($_POST["user_name"]);
    $pwd = trim($_POST["pwd"]);
    $pwdRepeat = $_POST["pwd_repeat"];
    $role = $_POST["user_role"];
    $errors = [];

    if (empty($user_name) || empty($pwd)){
        $errors[] = "Fill in all fields!";
    }

    if (strcmp($pwd, $pwdRepeat) != 0){
        $errors[] = "Passwords don't match!";
    }

    if (strlen($pwd) < 13){
        $errors[] = "PW too short!";
    }
    
    // $pattern = '/[0-9]/';
    // $pattern = '/[!@#$%^&*()_+{}\[\]:;<>,.?~\\\-]/';
    // $pattern = '/[A-Z]/';
    // preg_match($pattern,$pwd)

    if (isset($errors) && !empty($errors)){

        $_SESSION['errors'] = $errors;
        $errors = null;
        header("location: ../index.php?view=signup_user");
        die();

    } else {

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        include "../Classes/Dbh.class.php";
        include "../Classes/UserModel.class.php";
        $userModel = new UserModel();

        if($userModel->insertUser($user_name, $hashedPwd, $role ? $role : 'customer')){
            header("location: ../index.php?view=home");
            die();  
        } else {header("location: ../index.php?view=home");};
        
    }
    


}