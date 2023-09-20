<?php 
require_once 'maininclude.inc.php';

//Seite darf nur als Admin aufgerufen werden
$dba->requireAdmin();

// Welche Brand soll bearbeitet werden?
if(empty($_GET['id']) || !ctype_digit($_GET['id'])){
    exit('GET-Parameter ID fehlt!');
}
// Versuch: lade Brand anhand der ID
$brand = $dba->getBrandById($_GET['id']);
if($brand == false){
    exit('Brand not found.');
}

if(isset($_POST['bt_delete_brand']))
{
    $dba->deleteBrand($_GET['id']);
    header('Location: admin_brands.php');
    exit();
} else if(isset($_POST['bt_edit_brand']))
{
    $name = trim($_POST['name']);

    if(empty($name)){
        $errors[] = 'Bitte Name eingeben!';
    } else {
        $brandByNewName = $dba->getBrandByName($name);
        // wenn es bereits eine Marke mit dem (neuen) Namen gibt
        // und sich die IDs unterscheiden --> 2 Brands mit gleichem Namen
        if($brandByNewName != false && $brandByNewName->id != $brand->id){
            $errors[] = 'Marke bereits vorhanden.';
        }
    }

    $brand->name = $name;

    if(count($errors) == 0){
        $dba->editBrand($brand);
        // Weiterleitung
        header('Location: admin_brands.php');
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Edit brand</h1>
        <?php include 'showerrors.inc.php'; ?>
        <form action="admin_edit_brand.php?id=<?php echo $brand->id; ?>" method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" value="<?php echo $brand->name; ?>"><br>
            <button name="bt_edit_brand">Edit</button>
            <button name="bt_delete_brand">Delete</button>
        </form>
    </main>
</body>
</html>