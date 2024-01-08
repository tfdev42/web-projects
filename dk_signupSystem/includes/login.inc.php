<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        // ORDER DOES MATTER!
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";


        // ERROR HANDLERS
        $errors = [];

        if (is_input_empty($username, $pwd)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username); // can be User or False

        // check $result if it is a User for Username and PW match
        if (is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if ( ! is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        require_once "config_session.inc.php";

        if($errors){
            $_SESSION["errors_login"] = $errors;
            // Login Form shouldn't preserve input value if wrong

            // print out errors on index page
            header("Location: ../index.php");
            // exit script if errors true
            die();
        }

        // IF USER COULD LOG IN >> UPDATE SESSION COOKIE
        // grab user_id and associate with session_id
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"]; // APPEND THE USER'S ID
        session_id($sessionId); // SET SESSION ID TO THE NEWLY CREATED SESSION ID
        // since config_session.inc.php regenerates session_id every 30 minutes > have to change function too

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        // reset session regen cookie
        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php?login=success");

        // BEST PRACTICE : CLOSE PDO AND STMT
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {

        die("Query failed: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    die();
}