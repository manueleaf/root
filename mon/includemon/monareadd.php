<?php

if (isset($_POST["submit"])){

    $name = $_POST['monstruo'];
    $area = $_POST['area'];
    require_once '../../includes/dbhinc.php';
    require_once '../../includes/functionsinc.php';

    if(emptyInputMonArea($name, $area) !== false){
        header("location: ../monstare.php?=emptyinput");
        exit();
    }

    //Se puede implementar o no, si se implementa todos los monstruos tendrian el mismo ratio de aparición
    /*if(monAreaExists($conn, $name, $area)){
        header("location: ../monstare.php?=emptyinput");
        exit();
    }*/

    newMonArea($conn, $name, $area);
} else {
    header("location: ../monstare.php");
    exit;
}