<?php
    // um ein Cookie setzen zu koennen darf zuvor keine Ausgabe erfolgt sein
    if(isset($_POST['bt_ok'])){
        $currencyCode = $_POST['currency']; // EUR, USD, CHF

        // Cookie erstellen
        // time()+60*60 > 1 stnd gueltig
        setcookie('currency', $currencyCode, time()+60*60);
        header('Location: cookies.php');
    } elseif(isset($_POST['bt_delete'])){
        // Cookie loeschen
        // zum loeschen ist das Expiration Date in die Vergangenheit
        // zu setzen
        if(isset($_COOKIE['currency'])){
            unset($_COOKIE['currency']);
            setcookie('currency', '', time() - 60 * 60 * 24, '/');
            header('Location: cookies.php');
        }
    }
?>

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
            echo '<p>Cookie currency: '.htmlspecialchars($_COOKIE['currency']).'</p>';
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
        <button name="bt_delete">Waehrung loeschen</button>
    </form>
</body>
</html>