<?php require_once 'maininclude.inc.php';

    $dba->requireAdmin();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.inc.php';?>
    <main>
        <h1>Produkte (Admin)</h1>
        <p><a href="admin_create_product.php">Neues Produkt</a></p>

        <?php
            // Lade alle Produkte
            $products = $dba -> getProducts();

            echo count($products);
            
            foreach($products as $p){
                echo '<div lass="product">';
                echo '<h2>' . $p->name .'</h2>';
                // Hersteller laden
                $brand = $dba -> getBrandById($p->brand_id);
                echo '<p>Marke: ' . $brand -> name . '</p>';
                echo '<p>Preis: <strong>nur ' . $p -> price . 'EUR</strong></p>';


                echo '<img src="' . $p -> picture . '"class="product-img">';

                // Link zum bearbeiten
                echo '<p>
                <a href="admin_edit_product.php?id=' . $p -> id . '">Bearbeiten</a>
                </p>';

                echo '</div>';
            }
            
        ?>
    </main>
</body>
</html>