<?php require_once 'maininclude.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt Erstellen</title>
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Produkt erstellen</h1>
        <?php include 'showerrors.inc.php'; ?>
        <!-- Bei File-Uploads IMMER enctype="multipart/form-data" -->
        <form action="admin_create_product.php" method="POST" enctype="multipart/form-data">
            <label >SKU (Artikelnummer)</label><br>
            <input type="text" name="sku"><br>
            <label >Brand</label><br>
            <select name="brand_id">
                <?php 
                // alle Brands fuer dieses SELECT laden
                $brands = $dba->getBrands();
                foreach($brands as $b){
                    echo '<option value="'.$b->id.'">'.htmlspecialchars($b->name).'</option>';
                }
                ?>
            </select>

            <label>Category</label>
            <select name="category_id">
                <option value=""></option>
                <?php
                    $categories = $dba->getCategories();
                    foreach($categories as $c){
                        echo '<option value="'.$c->id.'">'.htmlspecialchars($c->name).'</option>'; 
                    }
                ?>
            </select><br>

            <label>Name</label><br>
            <input type="text" name="name"><br>
            <label>Descrition</label><br>
            <textarea name="descpription"></textarea><br>
            <label>Picture</label><br>
            <input type="file" name="picture"><br>
            <label>Price</label>
            <input type="text" name="price"><br>
            <label>Stock</label>
            <input type="text" name="stock"><br>

            <button name="bt_create_product">Speichern</button>
        </form>
    </main>
</body>
</html>


<!-- TODO: Category einfuegen und Editen -->