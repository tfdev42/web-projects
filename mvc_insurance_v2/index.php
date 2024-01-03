<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <main>
        <div class="form-wrapper">
            <h3>Login</h3>

            <form action="./includes/login.inc.php" method="post">
                <input type="text"
                        name="userid"
                        placeholder="UserID">
                <input type="password"
                        name="pwd"
                        placeholder="Password">
                <button type="submit" name="bt_login">Login</button>
            </form>
        </div>

        <div class="form-wrapper">
            <h3>Signup</h3>

            <form action="./includes/signup.inc.php" method="post">
                <?php display_signup_role_select(); ?>
            </form>

            <form action="./includes/signup.inc.php" method="post">
                <?php display_signup_form(); ?>
            </form>
        </div>




    </main>
</body>
</html>