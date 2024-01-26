<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once "./includes/autoload_classes.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <div>
        <p>Show Errors <br>
            <?php
                View::renderErrors();
            
            ?>
        </p>

        <p>Show Messages <br>
            <?php
                View::renderMessages();
            ?>
        </p>
    </div>
    
    <div class="wrapper">
        <form action="./includes/users.inc.php" method="post">
            <input type="text" name="first-name" placeholder="First Name">
            <input type="text" name="last-name" placeholder="Last Name">
            <!-- <input type="text" name="date-of-birth" placeholder="Date of Birth"> -->
            <label for="dob">Date of Birth:</label>

            <!-- Year dropdown -->
            <select name="year" id="year">
                <?php
                $currentYear = date("Y");
                $startYear = $currentYear - 100; // Adjust the range as needed
                for ($year = $currentYear; $year >= $startYear; $year--) {
                    echo "<option value=\"$year\">$year</option>";
                }
                ?>
            </select>

            <!-- Month dropdown -->
            <select name="month" id="month">
                <?php
                for ($month = 1; $month <= 12; $month++) {
                    $monthText = date("F", mktime(0, 0, 0, $month, 10));
                    echo "<option value=\"$month\">$monthText</option>";
                }
                ?>
            </select>

            <!-- Day dropdown -->
            <select name="day" id="day">
                <?php
                for ($day = 1; $day <= 31; $day++) {
                    echo "<option value=\"$day\">$day</option>";
                }
                ?>
            </select>

            <br>

            <button type="submit" name="submit">Submit</button>

        </form>
    </div>


</body>
</html>
