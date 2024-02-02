<form action="./includes/signup_user.inc.php" method="post">
    <input type="text" name="user_name" placeholder="Username">
    <input type="password" name="pwd" placeholder="Password">
    <input type="password" name="pwd_repeat" placeholder="Password Repeat">
    <input type="checkbox" id="user_role" name="user_role" value="agent">
    <label for="user_role"> Signup as Agent</label>
    <button type="submit" name="bt_signup">Signup</button>
</form>