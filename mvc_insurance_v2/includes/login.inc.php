<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "config_session.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["bt_login"])) {

    $userid = stripslashes(trim($_POST["id"]));
    $pwd = stripslashes(trim($_POST["pwd"]));

    try {
        require_once "dbh.inc.php";
        require_once "login_model.inc.php";
        require_once "login_contr.inc.php";

        if (is_input_empty($userid, $pwd)){
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $userid);

        if(is_username_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if(is_username_wrong($result) || is_password_wrong($pwd, $result["pwd"])){
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        
        // $_SESSION["test_login"] = $result;

        if($errors){
            $_SESSION["errors_login"] = $errors;
            $errors = array();

            header("Location: ../index.php");
            die();
        }

        

        // // add user id to session id and regenerate session_id
        // $newSessionId = session_id() . "_" . $result["id"];

        // // set new session_id
        // session_id($newSessionId);

        // //regenerate session_id
        // session_regenerate_id(true);

        $_SESSION["user_id"] = $result["id"];

        header("Location: ../index.php");

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