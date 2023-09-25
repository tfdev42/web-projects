<?php require_once 'maininclude.inc.php';


// Das zu bearbeitende Produkt laden
if(empty($_GET['id'])){
    exit('GET-parameter ID fehlt!');
}
// true: lade auch nicht-verfuegbare Produkte
$product = $dba -> getProductById($_GET['id'], true);
if($product == false){
    exit('Produkt nicht gefunden');
}


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

if(isset($_POST['bt_create_product'])){
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

    // Verschiebe die hochgeladene Datei in den projekteigenen uploads ordner
    $uploadPath = 'uploads/' . generateProductFileName($originalFilename);
    // verschieben
    $uploadOk = move_uploaded_file($tmpUploadPath, $uploadPath);

    if(!$uploadOk){
        $errors[] = 'Keine Datei ausgewaehlt!';
    }

    if(strlen($sku) == 0){
        $errors[] = 'SKU darf nicht leer sein';
    }elseif ($dba->getProductBySku($sku) != FALSE){
        // es darf nicht 2 Produkte mit gleicher SKU geben
        $errors[] = 'Es existiert bereits ein Produkt mit dieser SKU';
    }

    // Brand: Pflichtfeld
    $brand = $dba->getBrandById($brand_id);
    if($brand == FALSE){
        $errors[] = 'Brand darf nicht leer sein';
    }

    // Category: Optional
    $category = $dba->getCategoryById((int)$category_id);

    if(empty($name)){
        $errors[] = 'Name darf nicht leer sein';
    }

    if(is_numeric($price) == FALSE){
        $errors[] = 'Preis muss eine Zahl sein';
    }

    if(ctype_digit($stock) == FALSE){
        $errors[] = 'Stock muss eine ganze Zahl sein';
    }

    if(count($errors) == 0){
        if($category == FALSE){
            $categoryID = NULL;
        } else {
            $categoryID = $category->id;
        }
        $dba->createProduct($sku, $brand->id, $categoryID, $name, $description, $uploadPath, $price, $stock, false);

        header('Location: admin_product.php');
        exit();
    } else {
        // wenn es Fehler gab -> die upload Datei loeschen:
        unlink($uploadPath);
    }


    
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkt Bearbeiten</title>
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Produkt erstellen</h1>
        <?php include 'showerrors.inc.php'; ?>
        <!-- Bei File-Uploads IMMER enctype="multipart/form-data" -->
        <form action="admin_edit_product.php" method="POST" enctype="multipart/form-data">
            <label >SKU (Artikelnummer)</label><br>
            <input type="text" name="sku" value="<?php echo htmlspecialchars($product->sku); ?>"><br>
            <label >Brand</label><br>
            <select name="brand_id">
                <?php 
                // alle Brands fuer dieses SELECT laden
                $brands = $dba->getBrands();
                foreach($brands as $b){
                    // ist $b die bereits ausgewaehlte Marke?
                    if($b->id == $product->brand_id){
                        // vorauswaehlen! select="selected"
                        echo '<option value="' . $b -> id . '" select="selected">'.$b->name.'</option>';
                    } else {
                        echo '<option value="'.$b->id.'">'.$b->name.'</option>';
                    }


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
            <textarea name="description"></textarea><br>
            <!-- <label>Picture</label><br>
            <input type="file" name="picture"><br> -->
            <label>Price</label>
            <input type="text" name="price"><br>
            <label>Stock</label>
            <input type="text" name="stock"><br>

            <?php
                // checkbox fuer is_removed
                if($product->is_removed){
                    echo '<input type="checkbox" name="is_removed" checked>';
                } else {
                    echo '<input type="checkbox" name="is_removed">';
                }
            ?>

            <button name="bt_edit_product">Speichern</button>
        </form>

        <form action="admin_edit_product.php?id=<?php echo $product->id ?>" method="post" enctype="multipart/form-data">
            <h2>Bild bearbeiten</h2>
            <label>Picture</label><br>
            <input type="file" name="picture"><br>
            <button name="bt_edit_picture">Bild aktualisieren</button>

        </form>
    </main>
</body>
</html>


<!-- TODO: Category einfuegen und Editen -->