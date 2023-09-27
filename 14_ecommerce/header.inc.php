<header>
        <ul>
            <li>
                <a href="./">Index</a>
            </li>
            <?php if($dba->isLoggedIn()){ ?>

                <li>
                    <form action="index.php" method="POST">
                        <button name="bt_logout">Logout</button>
                    </form>
                </li>
                <li>
                    <a href="profile.php"><?php echo htmlspecialchars($user->fname . ' ' . $user->lname);?></a>                    
                </li>
                
                <?php if($dba->isAdmin()){?>
                <li><a href="admin_brands.php">Brands (Admin)</a></li>
                <li><a href="admin_product.php">Products (Admin)</a></li>
                <li><a href="admin_create_product.php">New Product (Admin)</a></li>
                <?php } ?>

            <?php } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="registration.php">Registration</a></li>
            <?php } ?>
        </ul>
</header>