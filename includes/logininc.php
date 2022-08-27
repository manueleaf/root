<?php

if (isset($_POST["submit"])){

    $username = $_POST["name"];
    $pwd = $_POST["pwd"];

    require_once 'dbhinc.php';
    require_once 'functionsinc.php';

    if(emptyInputLogin($username, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
} else {
    header("location: ../login.php");
    exit;
}