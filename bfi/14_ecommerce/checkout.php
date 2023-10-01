<?php
require_once 'maininclude.inc.php';



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
        <h1>Bestellung abschicken</h1>
        <?php
            include 'showerrors.inc.php';

        ?>
        <table>
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Bild</th>
                    <th>Einzelpreis</th>
                    <th>Menge</th>
                    <th>Gesamt</th>                    
                </tr>
            </thead>
            <tbody>
                <?php

                $total = 0;


                // Iterieren ueber das Session-Cart-Array
                foreach($_SESSION['cart'] as $entry){
                    $productId = $entry['product_id'];
                    $qty = $entry['qty'];

                    $product = $dba->getProductById($productId);
                    if($product == FALSE){
                        continue; // wenn das Produkt nicht mehr verfuegbar ist
                    }
                    echo '<tr>'; // Zeile
                    echo '<td><a href="product.php?id='.$product->id.'">'.htmlspecialchars($product->sku).'</a></td>'; // Spalte
                    echo '<td>'.htmlspecialchars($product->name).'</td>';
                    echo '<td><img src="'.$product->picture.'" style="max-height: 60px;"></td>';

                    $unitPrice = $product->price;
                    $productTotalPrice = $unitPrice * $qty;
                    $total += $productTotalPrice;
                    echo '<td>'.$unitPrice.' EUR</td>';
                    echo '<td>'.$qty.' Stueck</td>';
                    echo '<td>'.$productTotalPrice.' EUR</td>';
                    echo '</tr>';                    
                }
                ?>
            </tbody>
        </table>
        <p>
            Gesamtsumme: <strong><?php echo $total; ?> EUR.</strong>
        </p>

        <form action="checkout.php" method="post">
            <label>Strasse</label><br>
            <input type="text" name="address"><br>
            <label>PLZ</label><br>
            <input type="text" name="zip"><br>
            <label>Ort</label><br>
            <input type="text" name="city"><br>
            <label>Land</label><br>
            <input type="text" name="country">
            <button name="bt_checkout">Kostenpflichtig Bestellen</button>
        </form>
    </main>
</body>
</html>