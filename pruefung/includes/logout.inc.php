<?php
session_start();

if (isset($_POST["bt_logout"])){
    session_unset();
    session_destroy();

    header("location: ../index.php?view=home");
    die();
}

