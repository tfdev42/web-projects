<header>
    <nav class="user-menu">
        <ul>
            <li>
                <a href="./">Portal</a>
            </li>
            <?php if (isset($_SESSION['userId'])) { ?>
                <li>
                    <a href="profile.php">Personennummer: <?php echo htmlspecialchars($_SESSION['userId']);?></a>                    
                </li>
                <li>
                    <form action="logout.php" method="POST">
                        <button name="bt_logout">Logout</button>
                    </form>
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
</header>


