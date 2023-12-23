<header>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php if( ! isset($_SESSION["userid"])) {?>
            <li><a href="signup.php">Signup</a></li>
            <li><a href="login.php">Login</a></li>
            
        <?php }; ?>
        <?php if(isset($_SESSION["userid"])) {?>
            <li>Hello <?php echo $_SESSION["user_name"] ?></li>
            <li><a href="logout.php">Logout</a></li>
        <?php }; ?>
    </ul>
</header>