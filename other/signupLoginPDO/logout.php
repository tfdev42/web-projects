<?php

require_once "./main.inc.php";

session_destroy();

header("location: index.php");
exit();