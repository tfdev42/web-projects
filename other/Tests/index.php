<?php
session_start();
$foo = [];

for ($i = 1; $i < 5; $i++){
    $foo[$i] = "$i but String";
}


function showPOSTasArray(){
    if ($_SERVER["REQUEST_METHOD"] === "POST" || isset($_POST["bt_submit"])){
        $result = [];
        $post = $_POST;
        foreach($post as $k=>$v){
            if ($k === "bt_submit" || $k === "hidden_NAME") {
                continue;
            }
            $result[$k] = $v;
        }
        return $result;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests</title>
</head>
<body>
    <h3>Tests</h3>
    <div>
        <form action="./index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Name">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="hidden" name="hidden_NAME" value="hidden_value">  
            <button type="submit" name="bt_submit">Submit</button>          
        </form>
        
    </div>
    <div>
        <?php var_dump(showPOSTasArray()); ?>
        <br>
        <!-- <?php var_dump($foo); ?> -->
    </div>
</body>
</html>