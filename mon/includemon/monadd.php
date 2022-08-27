<?php
session_start();
if (isset($_POST["submit"])){

$imagen_monstruo = $_GET['id'];
$nameimagen = $_GET['id'].".png";
$extimagen = pathinfo($nameimagen);
$tmpimagen = $_FILES["imagen"] ["tmp_name"];
$ext =array("png","gif","jpg");
$urlnueva="../../../root/img/monsters/".$nameimagen;

if(is_uploaded_file($tmpimagen)) {
		move_uploaded_file($tmpimagen,$urlnueva);
		echo "Se ha guardado correctamente";

}else{
	echo "Elija una imagen";
	echo '<script> window.location="../modifmonst.php"; </script>';
}

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
    newMonster($conn, $name, $atk,$def,$hp,$spd);
} else {
    header("location: ../agregarMonstruo.php");
    exit;
}