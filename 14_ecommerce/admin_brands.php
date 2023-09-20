<?php
require_once 'maininclude.inc.php';
//Seite darf nur als Admin aufgerufen werden
$dba->requireAdmin();

$brands = $dba->getBrands();

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
        <h1>Brands</h1>
        <ul>
            <li><a href="admin_create_brand.php">Create brand</a></li>
        </ul>
        <?php 
        if(count($brands) == 0){
            echo '<p>Es gibt noch keine Marken!</p>';
        } else {
            echo '<ul>';
            foreach($brands as $brand){
                echo '<li>'
                    .htmlspecialchars($brand->name)
                    . ' <a href="admin_edit_brand.php?id='.$brand->id.'">bearbeiten</a>'  
                    .'</li>';
            }
            echo '</ul>';
        }
        ?>
    </main>
</body>
</html>