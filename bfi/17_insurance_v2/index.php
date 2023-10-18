<?php  
require_once 'maininclude.inc.php';

if(isset($_POST['bt_logout'])){
    $dba->logout();
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willkommen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.inc.php'; ?>
    <main>
        <h1>Beste Bootsversicherungen LLC</h1>
        
    </main>
</body>
</html>