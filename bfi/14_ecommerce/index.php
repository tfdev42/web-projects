<?php require_once 'maininclude.inc.php';

    if(isset($_POST['bt_logout'])){
        $dba->logout();
        header('Location: index.php');
        exit();
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
            // Lade alle Produkte
            $products = $dba -> getProducts();

            echo count($products);
            
            foreach($products as $p){

                // wenn $p nicht verfuegbar ist, dann ueberspringen
                if($p->isAvailable() == FALSE){
                    // aktuelles Produkt ueberspringen da nicht verfuegbar
                    continue;
                }
                echo '<div lass="product">';
                echo '<h2>' . $p->name .'</h2>';
                // Hersteller laden
                $brand = $dba -> getBrandById($p->brand_id);
                echo '<p>Marke: ' . $brand -> name . '</p>';
                echo '<p>Preis: <strong>nur ' . $p -> price . 'EUR</strong></p>';


                echo '<img src="' . $p -> picture . '"class="product-img">';

                // Link zum Produkt
                echo '<p>
                <a href="product.php?id=' . $p -> id . '">Details</a>
                </p>';

                echo '</div>';
            }
            
        ?>
    </main>
</body>
</html>