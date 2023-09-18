<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // Gibt es das Cookie?
        if(isset($_COOKIE['currency'])){

        } else {
            // Cookie existiert nicht
            echo '<p><b>Cookie currency existiert nicht.</b></p>';
        }
    ?>
    <form action="cookies.php" method="POST">
        <input type="radio" name="currency" value="EUR">
        <label>EUR</label><br>
        <input type="radio" name="currency" value="USD">
        <label>USD</label><br>
        <input type="radio" name="currency" value="CHF">
        <label>CHF</label><br>
        <button name="bt_ok">Waehrung seichern</button>
    </form>
</body>
</html>