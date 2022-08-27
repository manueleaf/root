<?php
    include_once 'header.php';
?>

<link rel="stylesheet" href="mystyle.css">
<body>

<div class="wrapper">
   <div class="form">
      <div class="title">Bienvenido</div>
      <div class="subtitle">¡Creemos su cuenta!</div>
      <form action="./includes/signupinc.php" method="post">
         <div class="input-container ic1">
            <input id="name" type="text" class="input" name="name" placeholder=" "  />
            <div class="cut cut-name"></div>
            <label for="name" class="placeholder">Nombre</label>
         </div>
         <div class="input-container ic2">
            <input id="uid" type="text" class="input" name="uid" placeholder=" "  />
            <div class="cut"></div>
            <label for="uid" class="placeholder">Username</label>
         </div>
         <div class="input-container ic2">
            <input id="email" type="text" class="input" name="email" placeholder=" " />
            <div class="cut cut-short"></div>
            <label for="email" class="placeholder">Correo</label>
         </div>
         <div class="input-container ic2">
            <input id="pwd" type="password" class="input" name="pwd" placeholder=" " />
            <div class="cut cut-pass"></div>
            <label for="pwd" class="placeholder">Contraseña</label>
         </div>
         <div class="input-container ic2">
            <input id="rptpwd" type="password" class="input" name="rptpwd" placeholder=" " />
            <div class="cut cut-long"></div>
            <label for="rptpwd" class="placeholder">Repetir Contraseña</label>
         </div>

         <?php
if (isset($_GET["error"])){
    if($_GET["error"]=="emptyinput"){
       echo "<div class='subtitle'>¡Llena todos los campos!</div>";
    } else if($_GET["error"]=="invalidusername"){
        echo "<div class='subtitle'>¡Hay caracteres invalidos en su nombre de usuario!</div>";
     } else if($_GET["error"]=="invalidemail"){
        echo "<div class='subtitle'>¡Coloque un email real!</div>";
     } else if($_GET["error"]=="pwderror"){
        echo "<div class='subtitle'>¡Las contraseñas no coinciden!</div>";
     } else if($_GET["error"]=="usertaken"){
        echo "<div class='subtitle'>¡Nombre de usuario ya existente!</div>";
     } else if($_GET["error"]=="stmterror"){
        echo "<div class='subtitle'>Algo salió mal, intentelo de nuevo</div>";
     } else if($_GET["error"]=="none"){
        echo "<div class='subtitle'>¡se ha inscrito con exito!</div>";
     }
} else
echo "<div class='empty'>.</div>";
?>

         <button type="submit" name="submit" class="submit">Enviar</button>
      </form>
</div>
</div>
</body>



<?php
    include_once 'pie.php';
?>