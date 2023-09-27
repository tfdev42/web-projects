<?php
require_once 'maininclude.inc.php';

if(isset($_POST['bt_add_to_cart'])){
    $productId = trim($_POST['product_id']);
    $qty = trim($_POST['qty']);

    if ($qty <= 0){
        $errors[] = 'Menge muss mind. 1 betragen!';
    } elseif(ctype_digit($qty) == FALSE){
        $errors[] = 'Menge muss ein ganze Zahl sein!';
    }
    // Laese Produkt, schaue ob es existiert bzw ob es verfuegbar ist
    $product = $dba->getProductById($productId);
    if($product == FALSE){
        $errors[] = 'Produkt ist nicht mehr verfuegbar!';
    }

    if(count($errors) == 0){
        $dba->addToCart($productId, $qty);
        header('Location: cart.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'header.inc.php';?>
    <main>
        <h1>Willkommen!</h1>
        <?php
            include 'showerrors.inc.php';
        ?>
    </main>
</body>
</html>