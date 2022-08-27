<?php
session_start();
?>
<?php
if (isset($_SESSION["useruid"])){
    require_once './includes/dbhinc.php';
    require_once './includes/functionsinc.php';
    userOnline($conn, $_SESSION["userid"]);
}
?>

<!DOCTYPE html>
<html dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111111;
}
</style>
    <body>
        <nav>
              <ul>
                  <?php
                  echo "<li><a href='index.php'>Inicio</a></li>";
                    if ($_SESSION["userrolid"]==2){
                        echo "<li><a href='listar.php'>Agregar Monstruos</a></li>";
                    }
                    echo "<li><a href='includes/logoutinc.php'>Log out</a></li>";
                    ?>
              </ul>
        </nav>
<?php
                   if (!isset($_SESSION["useruid"])){
                    header("location: ./index.php");
                   } 
?>
<!DOCTYPE html>
<style>
    body{
        background-color:black;
    }
    h1{
      margin: 0;
    }
    button:hover{
      background-color: #ddd;
    }
</style>
<div style="display: inline-block; position: relative;">
    <div 
    id="overlapdiv"
    style="background-color:black; position: absolute; top:0; right:0; left:0; bottom:0; opacity: 0; pointer-events: none; z-index: 10;"></div>

  
    <canvas></canvas>

<div id="UI" style= "display: none">

<!-- hp1-->
<div style="background-color: white; width:250px; position: absolute; top: 50px; left:50px; border: 4px black solid; padding: 12px;">
<div >
    <h1 id="nombreMonstruo" style="font-size:16px;">Monstruo</h1>
  </div>
<div style="position: relative">
  <div
          style="
            height: 5px;
            background-color: #bbb;
            margin-top: 50;
          "
        ></div>
        <div
        id="enemyHealth"
          style="
            height: 5px;
            background-color: green;
            margin-top: 10;
            position: absolute;
            top:0;
            left:0;
            right:0;
          "
        ></div>
      </div>
  </div>

  <!-- hp2-->
  <div style="background-color: white; width:250px; position: absolute; top: 330px; right:50px; border: 4px black solid; padding: 12px;">
    <h1 style="font-size:16px;">Personaje</h1>
<div style="position: relative">
  <div
          style="
            height: 5px;
            background-color: #bbb;
            margin-top: 50;
          "
        ></div>
        <div
        id="playerHealth"
          style="
            height: 5px;
            background-color: green;
            margin-top: 10;
            position: absolute;
            top:0;
            left:0;
            right:0;
          "
        ></div>
      </div>
  </div>

<div style="background-color: white; height: 140px; position: absolute; bottom: 0; left:0; right:0; border-top: 4px black solid; display: flex">

<div
id="dialogos" 
style="position:absolute; top:0; right:0; bottom:0; left:0; background-color:white; padding: 12px; display: none; cursor: pointer; font-size: 16px">
</div>
<div id= "cajasdeAtaque"style="width: 66.66%; display: grid; grid-template-columns: repeat(2, 1fr);">
</div>
<div id="Huida" style="display: grid; align-items: center; justify-content: center; width: 33.33%; border-left: 4px black solid;cursor: pointer;">
  <h1>Huir</h1>
</div>
</div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js" integrity="sha512-H6cPm97FAsgIKmlBA4s774vqoN24V5gSQL4yBTDOY2su2DeXZVhQPxFK4P6GPdnZqM9fg1G3cMv5wD7e6cFLZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="data/audio.js"></script>
<script src="data/attacks.js"></script>
<script src="data/monsters.js"></script>
<script src="data/collisions.js"></script>
<script src="data/pasto1Dato.js"></script>
<script src="data/pisoDato.js"></script>
<script src="data/classes.js"></script>
<script src="dex.js"></script>
<script src="batalla.js"></script>