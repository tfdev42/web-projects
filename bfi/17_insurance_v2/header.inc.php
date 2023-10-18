<header>
        <ul>
            <li>
                <a href="./">Home</a>
            </li>
            <?php if($dba->isLoggedIn()){ ?>

            <li>
                <form action="index.php" method="POST" id="form-inline">
                    <button name="bt_logout">Logout</button>
                </form>
            </li>
            <li>
                <!-- $user kommt aus maininclude.inc.php -->
                <a href="profile.php">
                    <?php echo htmlspecialchars($user->fname . ' ' . $user->lname); ?>
                </a>
            </li>

            <li><a href="manager_products.php">Products (Manager)</a></li>
            
            <li><a href="admin_users.php">Users (Emp)</a></li>
            <li><a href="admin_contracts.php">Contracts (Emp)</a></li>
            
            <?php } else { ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Registrierung</a></li>
            
            <?php } ?>
        </ul>
</header>