<?php require_once "main.inc.php";

if(isset($_POST["bt_submit"])){

    if(empty(clenseInput($_POST["name"]))){
        $errors[] = "Name is required";
    }

    if( ! filter_var(clenseInput($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email is required";
    }

    if(strlen(clenseInput($_POST["password"]) < 8)){
        $errors[] = "Password must be at least 8 characters long";
    }

    if( ! preg_match("/[a-z]/i", clenseInput($_POST["password"]))) {
        $errors[] = "Password must contain at least one letter";
    }

    if( ! preg_match('/[!@#$%^&*(),.?":{}|<>]/', clenseInput($_POST["password"]))){
        $errors[] = "Password must contain at least one special character";
    }

    if( ! preg_match('/\d/', clenseInput($_POST["password"]))){
        $errors[] = "Password must contain at least one number";
    }

    if( clenseInput($_POST["password"]) !== clenseInput($_POST["password_confirm"])) {
        $errors[] = "Entered passwords don't match";
    }

    

}

function getInputValue($field){
    return (isset($_POST[$field])) ? ($_POST[$field]) : "";
}

function clenseInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <main>
        <h1>Sign Up</h1>
        <?php include "./inc/showErrors.inc.php"; ?>
        
        <form id="signup" action="signup.php" method="post" novalidate>
            <div>
                <label for="name">Name</label>
                <input 
                name="name" 
                id="name" 
                type="text" 
                placeholder="Name" 
                value="<?php echo clenseInput(getInputValue("name")); ?>">
            </div>

            <div>
                <label for="email">Email</label>
                <input 
                name="email" 
                id="name" 
                type="text" 
                placeholder="email@example.com"
                value="<?php echo clenseInput(getInputValue("email")); ?>">
            </div>

            <div>
                <label for="password">Password</label>
                <input 
                name="password" 
                id="password" 
                type="password" 
                placeholder="Password123!"
                value="<?php echo clenseInput(getInputValue("password")); ?>">
            </div>

            <div>
                <label for="password_confirm">Confirm Password</label>
                <input 
                name="password_confirm" 
                id="password_confirm" 
                type="password" 
                placeholder="Repeat password"
                value="<?php echo clenseInput(getInputValue("password_confirm")); ?>">
            </div>
            <div>
                <button name="bt_submit" type="submit">Submit</button>
            </div>
        </form>
    </main>
    
    
    
</body>
</html>