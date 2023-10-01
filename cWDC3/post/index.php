<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    if($_POST){
        print_r($_POST);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <p>What is your name?</p>

    <p><input type="text" name="name"></p>
    <p><input type="submit" value="Submit"></p>
    </form>    
</body>
</html>