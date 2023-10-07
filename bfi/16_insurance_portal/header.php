<header>
    <div class="user-menu">
        <ul>
            <li>
                <a href="./">Portal</a>
            </li>
            <?php if (isset($_SESSION['user'])) { ?>
                <li>
                    <form action="index.php" method="POST">
                        <button name="bt_logout">Logout</button>
                    </form>
                </li>
                <li>
                    <a href="profile.php"><?php echo htmlspecialchars($user->fname . ' ' . $user->lname);?></a>                    
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
    </div>
</header>


