<?php

if (isset($_POST["submit"])){

    $name = $_POST['name'];

    require_once '../../includes/dbhinc.php';
    require_once '../../includes/functionsinc.php';

    if(emptyInputArea($name) !== false){
        header("location: ../agregarArea.php?=emptyinput");
        exit();
    }
    newArea($conn, $name);
} else {
    header("location: ../agregarArea.php");
    exit;
}