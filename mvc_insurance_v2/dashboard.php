<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "./includes/config_session.inc.php";
require_once "./includes/dashboard.inc.php";
require_once "./includes/dashboard_view.inc.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php isset($_SESSION["user_id"]) ? include "./includes/header.inc.php" : ''; ?>
    <main>
        <div>
        <h3>Welcome to the <?php echo htmlspecialchars($_SESSION["user_role"]); ?> Dashboard</h3>
        <section><?php if ($_SESSION["user_role"] === "manager") { ?>
            <form action="./dashboard.php" method="post">
                <button type="submit" name="bt_product_add">Add Product</button>
            </form>
            <?php } ?></section>
        <section><?php isset($_POST["bt_product_add"]) ? display_product_form() : ""; ?></section>
        </div>
            <?php display_products($products); ?>
        <div>
            <!-- <?php var_dump($_SESSION["test_id"]); ?> -->
        </div>
    </main>
    
    
</body>
</html>