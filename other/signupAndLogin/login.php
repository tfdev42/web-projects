<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $mysqli = require __DIR__ . "/database.php";

  $sql = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                  $mysqli->real_escape_string($_POST["email"])); // to avoid SQL injection, Escape special characters, if any

  $result = $mysqli->query($sql);

  $user = $result->fetch_assoc();
  // var_dump($user);
  // exit;

  // if a record was found >> check password
  if ($user) {
    if (password_verify($_POST["password"], $user["password_hash"])){
      die("Login successfull!");
    }
  }

  $is_invalid = true; // set also in html body

}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css"
    />
  </head>
  <body>
    <h1>Login</h1>

    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <form method="post">
      <label for="email">Email</label>
      <input type="email" name="email" id="email"
              value="<?php echo htmlspecialchars($_POST["email"] ?? "") ?>">

      <label for="password">Password</label>
      <input type="password" name="password" id="password">

      <button type="submit">Submit</button>

    </form>
  </body>
</html>
