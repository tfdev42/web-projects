<header>
    <nav>
        <li><a href="index.php?view=home">Home</a></li>
        <ul>
            <li><a href="index.php?view=products">Products</a></li>
        </ul>
        <?php
        if (Utils::isCustomerLoggedIn()) :
        ?>
            <ul>                
                <li><a href="index.php?view=orders">My Orders</a></li>
                <li><a href="index.php?view=profile">Profile</a></li>                
            </ul>
        <?php endif; ?>
        <?php
        if (Utils::isAgentLoggedIn()) :
        ?>
        <li><a href="index.php?view=sales">Analytics</a></li>
        <li><a href="index.php?view=signup_user">Signup User</a></li>
        <?php endif; ?>
        <ul>
            <li><h4>Hello 
            <?php if (Utils::isCustomerLoggedIn() || Utils::isAgentLoggedIn()) {                
                echo $_SESSION['user']['name'];
            } else echo "Guest"; ?></h4></li>
            <?php if(isset($_SESSION['user']['name'])) : ?>
            <li><form action="./includes/logout.inc.php" method="post">
                <button type="submit" name="bt_logout">Logout</button>
            </form></li>
            <?php endif; ?>
            
        </ul>
    </nav>
</header>