<?php
require_once 'main.include.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">;
</head>
<body>
    <main>
        <?php
            include 'validation.php';
            include 'showerrors.inc.php';
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="fname">Firstname: </label>
            <input type="text" name="fname"><br>
            <!-- <span class="error"><?php echo $fnameErr; ?></span><br> -->

            <label for="lname">Lastname: </label>
            <input type="text" name="lname"><br>
            <!-- <span class="error"><?php echo $lnameErr; ?></span><br> -->

            <label for="email">Email: </label>
            <input type="email" name="email"><br>
            <!-- <span class="error"><?php echo $emailErr; ?></span><br> -->

            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <!-- <span class="error"><?php echo $passwordErr; ?></span><br> -->

            <label for="street">Street: </label>
            <input type="text" name="street"><br>
            <!-- <span class="error"><?php echo $streetErr; ?></span><br> -->

            <label for="city">City: </label>
            <input type="text" name="city"><br>
            <!-- <span class="error"><?php echo $cityErr; ?></span><br> -->

            <label for="country">Country</label>
            <input type="text" name="country"><br>
            <!-- <span class="error"><?php echo $countryErr; ?></span><br> -->

            <label for="zip">ZIP</label>
            <input type="text" name="zip"><br>
            <!-- <span class="error"><?php echo $zipErr; ?></span><br> -->

            <button name="bt_register">Register</button>

        </form>
    </main>
</body>
</html>