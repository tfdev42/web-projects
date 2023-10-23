<?php
require_once 'maininclude.inc.php';

// darf nur Manager sehen
if(!$user->isManager()){
    header('location: index.php');
    exit();
}

// Seite darf nur als Manager aufgerufen werden

$products = $dba->getProducts();

if(isset($_POST['bt_create_product'])){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $pricePerMinute = trim($_POST['price_per_minute']);

    if(empty($name)){
        $errors[] = 'Bitte Name eingeben!';
    } 
    if(empty($description)){
        $errors[] = 'Bitte Beschreibung eingeben!';
    } 
    if(empty($pricePerMinute) || filter_var($pricePerMinute, FILTER_VALIDATE_FLOAT) == false){
        $errors[] = 'Bitte korrekten Preis pro Minute eingeben!';
    } 

    if(count($errors) == 0){
        $id = $dba->createProduct($name, $description, $pricePerMinute);
        // Weiterleitung
        header('Location: manager_products.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products (manager)</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Produkte</h1>
        <p>Diese Seite darf nur von Managern aufgerufen werden!</p>
        <?php include 'showerrors.inc.php'; ?>

        <h2>Neues Produkt</h2>
        <form action="manager_products.php" method="POST">
            <label>Name:</label><br>
            <input type="text" name="name"><br>
            <label>Leistungsbeschreibung:</label><br>
            <textarea name="description"></textarea><br>
            <label>Preis pro Minute:</label><br>
            <input type="text" name="price_per_minute"><br>
            <button name="bt_create_product">Create</button>
        </form>

        <h2>Produkte</h2>

        <table>
            <thead>
                <tr>
                    <th>P#</th>
                    <th>Name</th>
                    <th>Leistungen</th>
                    <th>€/min</th>
                    <th>Bearbeiten</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                foreach($products as $p){
                    echo '<tr>';
                    echo '<td>'.$p->id.'</td>';
                    echo '<td>'.htmlspecialchars($p->name).'</td>';
                    echo '<td>'.htmlspecialchars($p->description).'</td>';
                    echo '<td>'.htmlspecialchars($p->price_per_minute).' €/min</td>';
                    echo '<td></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
    </main>
</body>
</html>