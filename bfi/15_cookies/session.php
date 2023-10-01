<?php
    // session immer am anfang starten!!
    // --> verteilt das SESSION-ID COOKIE
    session_start();

    if(isset($_POST['bt_ok'])){
        $currencyCode = $_POST['currency'];

        // ausgewaehlte Waehrung in Session speichern
        $_SESSION['currency'] = $currencyCode;
        header('Location: session.php');
        exit();
    } elseif(isset($_POST['bt_delete_currency'])){
        // loesche ein K-V-P aus der Session
        unset($_SESSION['currency']);
        header('Location: session.php');
        exit();
    } elseif(isset($_POST['bt_delete_session'])){
        // Gesamte Session-Daten loeschen
        session_destroy();
        header('Location: session.php');
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
        // was steht in der Session?
        echo '<p>Session-ID: '.session_id().'</p>';

        // wurde ein Waehrung schon gespeichert?
        if(isset($_SESSION['currency'])){
            echo '<p>'.htmlspecialchars($_SESSION['currency']).'</p>';
        } else {
            echo '<p>Noch keine Waehrung in der Session gespeichert</p>';
        }
    ?>
    <form action="session.php" method="POST">
        <input type="radio" name="currency" value="EUR">
        <label>EUR</label><br>
        <input type="radio" name="currency" value="USD">
        <label>USD</label><br>
        <input type="radio" name="currency" value="CHF">
        <label>CHF</label><br>
        <button name="bt_ok">Waehrung seichern</button><br>
        <button name="bt_delete">Waehrung loeschen</button><br>
        <button name="bt_delete_currency">Currency loeschen</button><br>
        <button name="bt_delete_session">Session loeschen</button><br>
    </form>
</body>
</html>