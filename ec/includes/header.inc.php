<?php
include_once "../Classes/Utils.class.php";
?>

<header>
    <nav>
        <ul>
            <div class="header-left">
                <li><a href="./index.php">Home</a></li>
            </div>
            <div class="header-center">
                <?php if (Utils::isLoggedIn()) { ?>
                    <li><a href="products_page.inc.php">Products</a></li>
                    <li><a href="order.inc.php">Orders</a></li>
                    <li><a href="order.inc.php">Cart()</a></li>
               <?php } ?>
            </div>
            <div class="header-right">
                <?php if (! Utils::isLoggedIn()) {
                    echo "<li>";
                    Utils::showLoginButton();
                    echo "</li>";
                    echo "<li>";
                    Utils::showSignupButton();
                    echo "</li>";
                } else {
                    echo "<li>";
                    Utils::showLogoutButton();
                    echo "</li>";
                } ?>
                
            </div>          
        </ul>
    </nav>
</header>