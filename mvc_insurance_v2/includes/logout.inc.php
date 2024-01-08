<?php

if (isset($_POST["bt_logout"])){
    session_start();
    session_unset();
    session_destroy();

    header("location: ../index.php");
    die();
}
