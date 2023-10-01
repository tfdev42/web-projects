<?php 
require_once 'maininclude.inc.php';

if(isset($_POST['bt_registration']))
{
    $fname = trim($_POST['firstname']);
    $lname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if(!isset($_POST['tos'])){
        $errors[] = 'Please accept the TOS.';
    }
    if(strlen($fname) == 0){
        $errors[] = 'Please enter your firstname';
    }
    if(strlen($lname) == 0){
        $errors[] = 'Please enter your lastname';
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE){
        $errors[] = 'Please enter a valid email';
    } else if($dba->getUserByEmail($email) != FALSE){
        $errors[] = 'An account with this email already exists. Sorry!';
    }

    if(strlen($password) < 8){
        $errors[] = 'Your password must contain at least 8 chars';
    }

    if(count($errors) == 0){
        $userId = $dba->createUser($fname, $lname, $email, $password, false);
        header('Location: login.php?userid='.$userId);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create account</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Create account</h1>
        <?php include 'showerrors.inc.php'; ?>
        <form action="registration.php" method="POST">
            <label>Firstname</label><br>
            <input type="text" name="firstname"><br>
            <label>Lastname</label><br>
            <input type="text" name="lastname"><br>
            <label>Email</label>
            <input type="text" name="email"><br>
            <label>Password:</label><br>
            <input type="password" name="password"><br>
            <input type="checkbox" name="tos">
            <label>I accept the TOS</label><br>
            <button name="bt_registration">Registration</button>
        </form>
    </main>
</body>
</html>