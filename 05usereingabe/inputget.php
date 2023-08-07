<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formular mit GET Parametern</h1>
    <p>bei GET Parametern werden die Formulardaten in die Adresszeile uebertragen</p>

    <?php
    
    // wurde das Formular abgesendet?
    // --> auf die Formulardaten kann hier ueber die Variable $_GET zugegriffen werden
    if(isset($_GET['bt_submit'])){
        //wird nur ausgefuehrt wenn in $_GET das bt_submit gesetzt ist
        // Formulardaten in Variablen einlesen
        $firstname = $_GET['vorname'];
        $age = $_GET['alter'];
        $ageAusgabe = htmlspecialchars($age);

        echo '<p>Herzlich willkommen ' . htmlspecialchars($firstname) . '</p>';
        echo '<p>Du bist ' .htmlspecialchars($age). ' Jahre alt.</p>';
        echo "<p>$ageAusgabe</p>";

        // Cross-Site-Scripting - UNSAFE weil bei Usereingabe scripts eingegeeben werden koennen
        // <script>alert('Angriff!');</script>
        // <script>window.location="https://www.youtube.com/watch?v=xvFZjo5PgG0&pp=ygUNcmlja3JvbGwgbGluaw%3D%3D";</script>
        // Solution: htmlspecialchars()
    }
    
    ?>


    <form action="inputget.php" method="GET">
        <label for="vorname">Vorname</label><br>
        <input type="text" id="vorname" name="vorname"><br>

        <label for="alter">Alter</label><br>
        <input type="text" id="alter" name="alter"><br>
        
        <button name="bt_submit">Absenden</button>
    </form>
</body>
</html>