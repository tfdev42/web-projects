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
                GROUP BY p.id
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
        <h2>Welche 2 Produkte wurden am haeufigsten Bestellt?</h2>
        <!-- LIMIT 2 -->
        <?php
            $conn = $dba->getConn();
            // COALESCE liefert den ersten NICHT-NULL-Wert einer Aufzaehlung
            $ps = $conn->prepare('
                SELECT COALESCE(SUM(op.stock), 0) AS anzahl, p.name AS name
                FROM order_position op
                RIGHT JOIN product p ON(p.id = op.product_id)
                GROUP BY op.product_id
                ORDER BY anzahl DESC
                LIMIT 2
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
        <h2>Welche 2 Produkte wurden am seltesten Bestellt?</h2>
        <!-- ASC statt DESC -->
        <?php
            $conn = $dba->getConn();
            $ps = $conn->prepare('
                SELECT COALESCE(SUM(op.stock), 0) AS anzahl, p.name AS name
                FROM order_position op
                RIGHT JOIN product p ON(p.id = op.product_id)
                GROUP BY op.product_id
                ORDER BY anzahl ASC
                LIMIT 2
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
        <h2>Welche 2 Produkte wurden noch NIE Bestellt?</h2>
        <?php
            $conn = $dba->getConn();
            $ps = $conn->prepare('
                SELECT COALESCE(SUM(op.stock), 0) AS anzahl, p.name AS name
                FROM order_position op
                RIGHT JOIN product p ON(p.id = op.product_id)
                GROUP BY op.product_id
                HAVING anzahl = 0
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
        <h2>Welche 2 Produkte wurden noch NIE Bestellt?</h2>
        <?php
            $conn = $dba->getConn();
            $ps = $conn->prepare('
                SELECT p.name AS name
                FROM product p
                LEFT JOIN order_position op ON(p.id = op.product_id)
                WHERE op.id IS NULL
            ');
            $ps->execute();
            while($row = $ps->fetch()){
                echo '<p>';
                echo htmlspecialchars($row['name']);                
                echo '</p>';
            }
        ?>
        <h2>Anzahl der bestellungen von jeden Kunden</h2>
        <?php
            $conn = $dba->getConn();
            $ps = $conn->prepare('
                SELECT COALESCE(COUNT(o.id)) AS anzahl, u.fname, u.lname
                FROM user u 
                LEFT JOIN orders o ON(u.id = o.user_id)
                GROUP BY u.id
            ');
            $ps->execute();
            while($row = $ps->fetch()){
                echo '<p>';
                echo htmlspecialchars($row['fname'] . ' ' . $row['lname'] . ': ');
                echo $row['anzahl'];
                echo '</p>';
            }
        ?>
        <h2>Welche Bestellungen wurden in den Letzten 60 Minuten gemacht?</h2>
        <?php
            $conn = $dba->getConn();
            $ps = $conn->prepare('
                SELECT id, order_date
                FROM orders
                WHERE order_date > NOW() - INTERVAL 1 HOUR 
            ');
            $ps->execute();
            while($row = $ps->fetch()){
                echo '<p>';
                echo $row['id'] . ' ';
                echo $row['order_date'];                
                echo '</p>';
            }
        ?>
    </main>
</body>
</html>