<?php 
require_once 'maininclude.inc.php';
//Seite darf nur als Admin aufgerufen werden
$dba->requireAdmin();

if(isset($_POST['bt_create_brand']))
{
    $name = trim($_POST['name']);

    if(empty($name)){
        $errors[] = 'Bitte Name eingeben!';
    } else if($dba->getBrandByName($name) != FALSE){
        $errors[] = 'Marke bereits vorhanden.';
    }

    if(count($errors) == 0){
        $id = $dba->createBrand($name);
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
        <h1>Create brand</h1>
        <?php include 'showerrors.inc.php'; ?>
        <form action="admin_create_brand.php" method="POST">
            <label>Name:</label><br>
            <input type="text" name="name"><br>
            <button name="bt_create_brand">Create</button>
        </form>
    </main>
</body>
</html>