<?php
require_once "./config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    try {
        require_once "./dbh.inc.php";
        require_once "./orders_model.inc.php";


        if($_SESSION["user_role"] === "customer"){
            $_SESSION["orders"] = get_customer_orders($pdo, $_SESSION[user_id]);
        }

        if($_SESSION["user_role"] === "agent"){
            $_SESSION["orders"] = get_agent_orders($pdo);
        }

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../dashboard.php");
    die();
}