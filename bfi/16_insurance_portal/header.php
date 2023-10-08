<?session_start();?>
<header>
    <div class="user-menu">
        <nav>
        <ul>
            <li>
                <a href="./">Portal</a>
            </li>
            <?php if (isset($_SESSION['userId'])) { ?>
                <li>
                    <form action="index.php" method="POST">
                        <button name="bt_logout">Logout</button>
                    </form>
                </li>
                <li>
                    <a href="profile.php"><?php echo htmlspecialchars($_SESSION['userFname'] . ' ' . $_SESSION['userLname']);?></a>                    
                </li>
                <?php } else { ?>
                    <li>
                        <form action="login.php" method="POST">
                            <button name="bt_login">Login</button>
                        </form>
                    </li>
                    <li>
                        <form action="register.php" method="POST">
                            <button name="bt_register">Register</button>
                        </form>
                    </li>
                    <?php } ?>
        </ul>
        </nav>        
    </div>
</header>


