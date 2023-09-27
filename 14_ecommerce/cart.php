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

if(isset($_POST['bt_delete_from_cart'])){
    $productId = trim($_POST['product_id']);
    $dba->deleteFromCart($productId);
    header('Location: cart.php');
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
        <h1>Warenkorb</h1>
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
                    <th>Loeschen</th>
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
                    echo '<td><a href="product.php?id="'.$product->id.'">'.htmlspecialchars($product->sku).'</a></td>'; // Spalte
                    echo '<td>'.htmlspecialchars($product->name).'</td>';
                    echo '<td><img src="'.$product->picture.'" style="max-height: 60px;"></td>';

                    $unitPrice = $product->price;
                    $productTotalPrice = $unitPrice * $qty;
                    $total += $productTotalPrice;
                    echo '<td>'.$unitPrice.' EUR</td>';
                    echo '<td>'.$qty.' Stueck</td>';
                    echo '<td>'.$productTotalPrice.' EUR</td>';

                    // Loeschen Button
                    ?>
                    <td>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <button name="bt_delete_from_cart">Loeschen</button>
                        </form>
                    </td>
                    <?php echo '</tr>';                    
                }
                ?>
            </tbody>
        </table>
        <p>
            Gesamtsumme: <strong><?php echo $total; ?> EUR.</strong>
        </p>
    </main>
</body>
</html>