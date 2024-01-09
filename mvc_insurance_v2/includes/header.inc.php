<?php
require_once "./includes/config_session.inc.php";




?>

<header>
    <ul>
        <li>
            <a href="./dashboard.php">Home</a>
        </li>
        <li>ID: <?php echo $_SESSION["user_id"] ?> </li>
        
            <?php if ($_SESSION["user_role"] !== "manager") { ?>
                <li>
                    <form action="./orders.inc.php" method="post">
                        <input type="hidden" name="show_orders" value="<?php $_SESSION["user_id"] ?>">
                        <button type="button">Orders</button>
                    </form>                    
                </li>
            <?php } ?>
        
        <li>
            <form action="./includes/logout.inc.php" method="post">
                <button type="submit" name="bt_logout">Logout</button>
            </form>
        </li>
        
    </ul>
</header>