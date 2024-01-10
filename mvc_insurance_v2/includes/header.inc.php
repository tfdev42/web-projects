<?php
require_once "./includes/config_session.inc.php";




?>

<header>
    <ul>
        <li>
            <form action="../dashboard.php" method="post">                        
                <button type="submit" name="show_home">Home</button>
            </form> 
        </li>
        <li>ID: <?php echo $_SESSION["user_id"] ?> </li>
        
            <?php if ($_SESSION["user_role"] !== "manager") { ?>
                <li>
                    <form action="../dashboard.php" method="post">                        
                        <button type="submit" name="show_orders">Orders</button>
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