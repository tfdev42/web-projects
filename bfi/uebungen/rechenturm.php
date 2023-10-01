<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechenturm</title>
</head>
<body>
    <h1>Rechenturm</h1>
    <p>rechenturm erzeugen</p>

    <form action="rechenturm.php" method="GET">
        <label for="multiplicant">Multiplicant</label><br>
        <input type="text" id="multiplicant" name="multiplicant"><br>
        <button name="bt_submit">Submit</button><br>
    </form>

    <?php
        // WARNINGS
        // Enable WARNINGS ON LINUX >>>>>>
        error_reporting(E_ALL);

        ini_set('display_errors','1');
        // >>>>>>>>>>>>
    
        if(isset($_GET['bt_submit'])){

            $multiplicant = (int)$_GET['multiplicant'];
            //echo 'multiplicant = ' . (int)$multiplicant;

            for ($i=1; $i<=10; $i++){
                $result = (int)($i * $multiplicant);
                echo '<p>' . $i . " x " . $multiplicant . ' = '; 
                if ($i > 1){
                    for($n=1; $n<$i; $n++){
                        echo $multiplicant . ' + ';
                    };           
                }
                echo $multiplicant . ' = ' . $result . '</p>';
            };
        };  

    

    ?>

    

</body>
</html>