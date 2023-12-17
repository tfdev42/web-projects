<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JS / Hello World!</title>
</head>
<body>

    <p>
        <h1 id="text">Hello World!</h1>
    </p>
    <p>
        <button id="button">Change Text</button>
    </p>
    <p id="secondParagraph">
        Javascript is ...
    </p>
    <button id="secondButton">Replace the "..."</button>


    <script type="text/javascript">
        document.getElementById("button").onclick = function(){
            document.getElementById("text").innerHTML = prompt("Please enter the text to be changed to!");
        }

        document.getElementById("secondButton").onclick = function(){
            document.getElementById("secondParagraph").innerHTML = document.getElementById("secondParagraph").innerHTML.replace("...", prompt("What is JavaScript like?"));
        }
    </script>

</body>
</html>