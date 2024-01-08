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
                    <a href="./orders.inc.php">Orders</a>
                </li>
            <?php } ?>
        
        <li>
            <form action="./includes/logout.inc.php" method="post">
                <button type="submit" name="bt_logout">Logout</button>
            </form>
        </li>
        
    </ul>
</header>