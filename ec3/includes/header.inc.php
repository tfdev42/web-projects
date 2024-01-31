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
                <li><a href="index.php?view=cart">Cart</a></li>
                <li><a href="index.php?view=orders">My Orders</a></li>
                <li><a href="index.php?view=profile">Profile</a></li>                
            </ul>
        <?php endif; ?>
        <?php
        if (Utils::isAdminLoggedIn()) :
        ?>
        <li><a href="index.php?view=sales">Sales</a></li>
        <?php endif; ?>
        <ul>
            <h4>Hello 
            <?php if (Utils::isCustomerLoggedIn()) {
                echo $_SESSION["user"]["email"];
            } elseif (Utils::isAdminLoggedIn()) {
                echo "Admin";
            }else echo "Guest"; ?></h4>
        </ul>
    </nav>
</header>