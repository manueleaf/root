<?php

if (isset($_POST["submit"])){

    $id = $_POST['id'];
    $name = $_POST['name'];
    $atk = $_POST['atk'];
    $def = $_POST['def'];
    $hp = $_POST['hp'];
    $spd = $_POST['spd'];

    require_once '../../includes/dbhinc.php';
    require_once '../../includes/functionsinc.php';

    if(emptyInputMonster($name, $atk,$def,$hp,$spd) !== false){
        header("location: ../agregarMonstruo.php?=emptyinput");
        exit();
    }
    updateMonster($conn, $_POST['name'], $atk,$def,$hp,$spd, $id);
} else {
    header("location: ../agregarMonstruo.php");
    exit;
}