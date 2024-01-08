<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "./config_session.inc.php";

if (isset($_POST["bt_product_confirm"])){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $ppm = $_POST["price_per_minute"];

    try {
        require_once "./dbh.inc.php";
        require_once "./product_model.inc.php";

        set_product($pdo, $name, $description, $ppm);

        $pdo = null;
        $stmt = null;
        header("Location: ../dashboard.php");

        


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

if (isset($_POST["bt_product_remove"])){
    $_SESSION["product_id"] = $_POST["product_id"];

    try {
        require_once "./dbh.inc.php";
        require_once "./product_model.inc.php";

        remove_product($pdo, $_SESSION["product_id"]);

        $pdo = null;
        $stmt = null;
        $_SESSION["product_id"] = null;
        header("Location: ../dashboard.php");

        


    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}