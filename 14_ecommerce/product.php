<?php
require_once 'maininclude.inc.php';

if(empty($_GET['id'])){
    exit('GET Parameter ID fehlt!');
}
$product = $dba->getProductById($_GET['id']);
if($product == FALSE){
    exit('Produkt nicht gefunden');
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
        <h1>Produkt</h1>
        <?php
           
            echo '<div lass="product">';
            echo '<h2>' . htmlspecialchars($product->name) .'</h2>';
            // Hersteller laden
            $brand = $dba -> getBrandById($product->brand_id);
            echo '<p>Marke: ' . $brand -> name . '</p>';
            
            // SKU, Preis, Description
            echo '<p>' . htmlspecialchars($product->description) . '</p>';

            // Category
            if($product->category_id == NULL){
                echo '<p>Das Produkt hat keine Kategorie</p>';
            } else {
                $category = $dba->getCategoryById($product->category_id);
                echo '<p>Kategorie: ' . htmlspecialchars($category->name) . '</p>';
            }

            echo '<img src="' . $product -> picture . '"class="product-img">';

            // Link zum Produkt
            echo '<p>
            <a href="product.php?id=' . $product -> id . '">Details</a>
            </p>';
            echo '<p>Preis: <strong>nur ' . $product -> price . 'EUR</strong></p>';
            echo '</div>';
        
            
        ?>
    </main>
</body>
</html>