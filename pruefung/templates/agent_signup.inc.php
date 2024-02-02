<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['bt_agent_signup'])){
    $username = $_POST['user_name'];
    $pwd = $_POST['pwd'];

    include "../Classes/UserModel.class.php";

    $userModel = new UserModel();

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $userModel->insertUser($username, null,null,$hashedPwd,null);

    header("Location: ../index.php");
    exit();
}