<?php
// Set a unique key
$uniqueKey = uniqid();
$_SESSION['redirect_key'] = $uniqueKey;
?>
<header>
    <nav>
        <ul>
            <li><a href="./">Home</a></li>
            <li><a href="index.php?view=products&key=<?php echo $uniqueKey ?>">Products</a></li>
            <?php if (Utils::isCustomerLoggedIn()) : ?>
            <li><a href="index.php?view=cart&key=<?php echo $uniqueKey ?>">Cart</a></li>
            <li><a href="index.php?view=orders&key=<?php echo $uniqueKey ?>">Orders</a></li>        
            <?php endif; ?>
            <?php if (Utils::isAdminLoggedIn()) : ?>
            <li><a href="index.php?view=analytics&key=<?php echo $uniqueKey ?>">Analytics</a></li>
            <?php endif; ?>
            <li>Hello <?php if (Utils::isLoggedIn()) : ?>
            <a href="index.php?view=profile&key=<?php echo $uniqueKey ?>">
                <?php echo $_SESSION["user"]["name"]; ?>
            </a>
            <?php else : ?>
                Guest
            <?php endif; ?></li>
            <?php if (Utils::isLoggedIn() === false) : ?>
            <li><a href="index.php?view=signup&key=<?php echo $uniqueKey ?>">Signup</a> or 
                <a href="index.php?view=login&key=<?php echo $uniqueKey ?>">Login</a></li>
            <?php endif; ?>
            <?php if (Utils::isLoggedIn()) : ?>
            <li><a href="index.php?view=logout&key=<?php echo $uniqueKey ?>">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>