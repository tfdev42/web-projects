<?php
require_once "main.inc.php";

if(isset($_POST["submit"])){
    if ( ! $dba->isEmailTaken($_POST['email'])) {
        $errors[] = "Wrong email";
    }

    $user = $dba->getUserByEmail($_POST["email"]);
    $user_pw = $user->password;
    if ( ! password_verify($_POST["password"], $user_pw)){
        $errors[] = "Wrong password";
    }

    if(count($errors) == 0){
        $_SESSION["userid"] = $user->id;
        $_SESSION["user_name"] = $user->name;
        $_SESSION["user_email"] = $user->email;

        header("location: index.php");
        exit();
    }

    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <main>
        <h1>Login</h1>
        <?php include "./inc/showErrors.inc.php"; ?>
        <form action="login.php" method="post">
            <div class="login-area">
                <div class="input-field">
                    <label for="email">Email</label>
                    <input 
                    type="email" 
                    name="email" 
                    id="email-login">
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password-login">
                </div>
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </main>
    
</body>
</html>