<?php
declare(strict_types=1);

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_id"])){

    // get_user_info(); if customer then:
    // get_billing_address();
    // get_cart();

} else {
    header("Location: index.php");
    die();
}