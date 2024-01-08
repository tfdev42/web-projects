<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "./config_session.inc.php";

if (isset($_POST["bt_product_order"])){
    $_SESSION["product_id"] = $_POST["product_id"];

    try {
        require_once "./dbh.inc.php";
        require_once "./order_model.inc.php";

        order_product($pdo, $_SESSION["product_id"], $_SESSION["user_id"]);

        $pdo = null;
        $stmt = null;
        $_SESSION["product_id"] = null;

        header("Location: ../dashboard.php");       


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}