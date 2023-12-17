<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="circle-container">
        <div id="red" class="circle" onclick="hideOnClick('red')"></div>
        <div id="blue" class="circle" onclick="hideOnClick('blue')"></div>
        <div id="yellow" class="circle" onclick="hideOnClick('yellow')"></div>
    </div>
    

    <script>

        function hideOnClick(color){
            var circle = document.getElementById(color)
            if (circle.classList.contains('hidden')) {
                circle.classList.remove('hidden');
            } else {
                circle.classList.add('hidden');
      }
        }
    </script>
</body>
</html>