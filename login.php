<?php
    include_once 'header.php';
?>

<link rel="stylesheet" href="mystyle.css">

<div class="form2">
      <div class="title">Iniciar sesion</div>
      <form action="includes/logininc.php" method="post">
      <div class="input-container ic1">
        <input id="name" class="input" type="text" name="name" placeholder=" " />
        <div class="cut cut-uid"></div>
        <label for="name" class="placeholder">Usuario/Correo</label>
      </div>
      <div class="input-container ic2">
        <input id="pwd" class="input" type="password" name="pwd" placeholder=" " />
        <div class="cut"></div>
        <label for="pwd" class="placeholder">Contraseña</>
      </div>
      <?php
if (isset($_GET["error"])){
    if($_GET["error"]=="emptyinput"){
      echo "<div class='subtitle'>¡Llena todos los campos!</div>";
    } else if($_GET["error"]=="wronglogin"){
      echo "<div class='subtitle'>Usuario o contraseña incorrecto</div>";
     }
}else
 echo "<div class='empty'>.</div>";

?>
      <button type="submit" name="submit" class="submit">Ingresar</button>
      </form>
    </div>




<?php
    include_once 'pie.php';
?>