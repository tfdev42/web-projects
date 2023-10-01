<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    if($_POST){
        $family = array("Henry", "Ellen", "Jackson", "John");

        $isKnown = false;

        foreach($family as $member){
            if($member == $_POST['name']){
                $isKnown = true;
                break;
            }
        }

        if($isKnown){
            echo '<p>Hi there, <strong>' . $_POST['name'] . '</strong>!</p>';
            echo '<p>Your age is, <strong>' . $_POST['age'] . '</strong>!</p>';
        } else echo '<p><strong>I dont know you</strong>!</p>';
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <p>What is your name?</p>
    <p><input type="text" name="name"></p>    
    <p>What is your age?</p>
    <p><input type="text" name="age"></p>
    <p><input type="submit" value="Submit"></p>
    </form>    
</body>
</html>