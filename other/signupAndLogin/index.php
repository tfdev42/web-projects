<?php

session_start();

// print_r($_SESSION);

//display Name of current user
// user_id is set in login.php
if (isset($_SESSION["user_id"])){

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    
    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css"
    />
  </head>
  <body>
    <h1>Home</h1>
    <?php if (isset($user)): ?>    
        <p>Hello <?php echo htmlspecialchars($user['name']); ?></p>
        <p><a href="logout.php">Log out.</a></p>
    <?php else: ?>
        <p><a href="login.php">Log In</a> or <a href="signup.html">sign up.</a></p>
    <?php endif; ?>

  </body>
</html>