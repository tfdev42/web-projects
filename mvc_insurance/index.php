<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insurance Home</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
</head>
<body>
    <main>
        <h3>Login</h3>

        <form action="./includes/login.inc.php" method="post">
            <label for="login_userid">UserID</label>
            <input type="text"
                    id="login_userid"
                    name="userid"
                    placeholder="UserID">
            <label for="login_pwd">Password</label>
            <input type="password"
                    name="pwd"
                    placeholder="Password"
                    id="login_pwd">

            <button type="submit" name="bt_login">Login</button>

        </form>

        
        <h3>Signup</h3>

        <form action="./includes/signup.inc.php" method="post">
            <input type="text" name="fname" placeholder="Firstname">
            <input type="text" name="lname" placeholder="Lastname">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="street" placeholder="Street">
            <input type="text" name="city" placeholder="City">
            <input type="text" name="country" placeholder="Country">
            <input type="text" name="zip" placeholder="ZIP">

            <label>
            <input type="radio" name="role" value="customer"> Customer
            </label>
            <label>
                <input type="radio" name="role" value="manager"> Manager
            </label>
            <label>
                <input type="radio" name="role" value="agent"> Agent
            </label>
            <br>
            <label>Payment Option</label>
            <label>
            <input type="radio" name="payment-type" value="1"> Bill 
            </label>
            <label>
                <input type="radio" name="payment-type" value="2"> IBAN
            </label>
            <br>
            <button type="submit" name="bt_signup">Signup</button>        
        </form>
    </main>
    
</body>
</html>