<?php
require_once "./includes/config_session.inc.php";
require_once "./includes/header.inc.php";



?>

<header>
    <ul>
        <li>
            <a href="./dashboard.php">Home</a>
        </li>
        <li>
            <form action="./includes/logout.inc.php" method="post">
                <button type="submit" name="bt_logout">Logout</button>
            </form>
        </li>
        
    </ul>
</header>