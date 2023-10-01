<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation</title>
</head>
<body>
    <h1>Rechner mit Operatorauswahl und Formularvalidierung</h1>

    <?php

        $errors = [];

        // Wurde das Formular abgesendet
        if(isset($_GET['bt_rechnen'])){
            $z1 = trim($_GET['z1']); // LEERZEICHEN trimmen, loescht alle Leerzeichen am Anfang und Ende eines Strings weg
            $z2 = trim($_GET['z2']);

            // Kommazahlen: 1.5 und NICHT 1,5
            // jeden beistrich durch einen . ersetzen
            $z1 = str_replace(',','.',$z1);
            $z2 = str_replace(',','.',$z2);

            // pruefe ob z1 nicht numerisch ist
            if(is_numeric($z1) == false){
                // eine FM hinzufuegen
                // wenn z1 false >> false == false = true
                // schreibe die FMM als Element in das $errors
                $errors[] = 'Bitte Zahl 1 nur Zahlen eingeben!';
            }

            if(!is_numeric($z2)){
                $errors[] = 'Bitte Zahl 2 nur Zahlen eingeben!';
            }


            $op = '';
            if(isset($_GET['operator'])){
                $op = $_GET['operator'];
            } else {
                $errors[] = 'Bitte Operator waehlen!';
            }

            // wenn die Formulavalidierung abgeschlossen wurde,
            // soll gerechnet werden wenn es bisher keine FMs gab
            if(count($errors) == 0){
                $ergebnis = 0;
                $operatorAusgabe = '';

                if($op == 'plus'){
                    $ergebnis = $z1 + $z2;
                    $operatorAusgabe = '+';
                } elseif ($op == 'minus'){
                    $ergebnis = $z1 - $z2;
                    $operatorAusgabe = '-';
                } elseif ($op == 'multi'){
                    $ergebnis = $z1 * $z2;
                    $operatorAusgabe = '*';
                } elseif ($op == 'division'){
                    $ergebnis = $z1 / $z2;
                    $operatorAusgabe = '/';
                }
                echo '<p><strong>' .htmlspecialchars($z1 . ' ' . $operatorAusgabe . ' ' . $z2 . ' = ' . $ergebnis) . '</strong></p>';

            }

        }

        if(isset($_GET['bt_register'])){
            $name = trim($_GET['name']);
            $email = trim($_GET['email']);
            $age = trim($_GET['age']);

            // Name muss eingegeben werden
            if(empty($name)){
                $errors[] = 'Name muss eingegeben werden!';
            }elseif (strlen($name) > 100){
                $errors[] = 'Name darf nicht mehr als 100 Zeichen enthalten!';
            }

            // Email ueberpruefen
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email ist ungueltig!';
            }

            // Age muss im bereich 0 - 110 sein
            // Alter muss im bereich sein
            // ist age eine ganze zahl?
            if(!ctype_digit($age)){
                $errors[] = 'Age muss eine Ganze Zahl sein!';
            }elseif($age > 110 || $age < 0){
                $errors[] = 'Age muss im bereich 0-110 sein!';
            }
        }

        // Ausgabe der Fms

        // Gibt es FMs?
        if(count($errors) > 0){
            echo '<ul>';
                // fuer jedde FM eine <li></li> generieren
                for ($i = 0; $i < count($errors); $i++){
                    // Hole die FM aus dem Array
                    $msg = $errors[$i];
                    // die FM als Listeneintrag ausgeben
                    echo '<li>' .htmlspecialchars($msg). '</li>';
                }
            echo '</ul>'; // FMs in eine UL ausgeben
        }



    ?>

    <form action="validation.php" method="GET">
        <label for="z1">Zahl 1</label><br>
        <input type="text" name="z1"><br>

        <input type="radio" name="operator" value="plus">
        <label for="plus">+</label><br>
        <input type="radio" name="operator" value="minus">
        <label for="minus">-</label><br>
        <input type="radio" name="operator" value="multi">
        <label for="multi">*</label><br>
        <input type="radio" name="operator" value="division">
        <label for="division">/</label><br>

        <label for="z2">Zahl 2</label><br>
        <input type="text" name="z2"><br>

        <button name="bt_rechnen">Berechnen</button>
        <input type="reset">
    </form>

    <h2>Alter, Name, Email</h2>
    <form action="validation.php" method="GET">
        <label for="name">Name:</label><br>
        <input type="text" name="name"><br>

        <label for="email">Email:</label><br>
        <input type="text" name="email"><br>

        <label for="alter">Age:</label><br>
        <input type="text" name="age"><br>

        <button name="bt_register">Registrieren</button>
    </form>
</body>
</html>