<?php require_once 'maininclude.inc.php';

// Generiert einen zufaelligen Dateinamen fuer das hochgeladene Produkt-Bild
function generateProductFileName($originalName){
    // --> finde die Dateiendung heraus
    // finde den Index vom letyten Punkt im String
    $dotIndex = strrpos($originalName, '.');

    // Hole alle Zeichen ab dem Index vom letzten '.' bis zum Ende
    $filetype = substr($originalName, $dotIndex);

    $filename = time() . '_' . rand(10000, 99999) . $filetype;
    return $filename;
}

// nur Admin
$dba->requireAdmin();

if(isset($_POST['bt_create_prduct'])){
    $sku = trim($_POST['sku']);
    $brand_id = trim($_POST['brand_id']);
    $category_id = trim($_POST['category_id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    //picture
    $price = trim($_POST['price']);
    $stock = trim($_POST['stock']);

    // File upload
    // wie ist der Originale Dateiname?
    $originalFilename = $_FILES['picture']['name'];
    $tmpUploadPath = $_FILES['picture']['tmp_name'];
    echo "<p>Original: $originalFilename, TMP: $tmpUploadPath</p>";
}


?>
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