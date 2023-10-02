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
        <h1>Analytics!</h1>
        <h2>Wie oft wurde jedes Produkt bestellt?</h2>
        <?php
            $conn = $dba->getConn();
            // COALESCE liefert den ersten NICHT-NULL-Wert einer Aufzaehlung
            $ps = $conn->prepare('
                SELECT COALESCE(SUM(op.stock), 0) AS anzahl, p.name AS name
                FROM order_position op
                RIGHT JOIN product p ON(p.id = op.product_id)
                GROUP BY op.product_id
                ORDER BY anzahl DESC
            ');
            $ps->execute();
            while($row = $ps->fetch()){
                echo '<p>';
                echo htmlspecialchars($row['name']);
                echo ': ';
                echo $row['anzahl'];
                echo '</p>';
            }
        ?>
    </main>
</body>
</html>