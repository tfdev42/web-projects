<?php
if (isset($_SESSION["signup_data"])) {
    $userName = $_SESSION["signup_data"]["user_name"];
    $userEmail = $_SESSION["signup_data"]["email"];
}
?>
<form action="./inc/signup.inc.php" method="post">
    <label for="user_name">Username</label><br>
    <input type="text" name="user_name" value="<?php echo isset($userName) ? $userName : ""; ?>"><br>
    <label for="email">Email</label><br>
    <input type="email" name="email" value="<?php echo isset($userEmail) ? $userEmail : ""; ?>"><br>
    <label for="password">Password</label><br>
    <input type="password" name="password"><br>
    <label for="password_repeat">Repeat Password</label><br>
    <input type="password" name="password_repeat"><br>
    <button type="submit">Signup</button>
</form>