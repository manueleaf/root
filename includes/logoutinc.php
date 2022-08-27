<?php
session_start();
require_once './dbhinc.php';
require_once './functionsinc.php';
userOffline($conn, $_SESSION["userid"]);
session_unset();
session_destroy();



header("location: ../index.php");
exit();
