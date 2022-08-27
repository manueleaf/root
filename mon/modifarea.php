<?php
    include_once '../header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<ul>";
    echo "<li><a href='agregararea.php'>Regresar</a></li>";
    echo "</ul>";
   } else {
   header("location: ../index.php");
   exit();}
   ?>

 <!DOCTYPE html>
 <html>
 <head>
 </head>
 <body>
 <form method="post" action="./includemon/areadd.php" class="register">
                            <div>
					        	<label>Nombre Area: </label>
					        	<input style="border-radius: 5px" type="text" name="name" autocomplete="on" placeholder="nombre" required>
					        </div>
					        <div><input type="submit" style="border-radius: 5px; font-size:15px;" class="btn btn-success" name="submit" value="Enviar"></div>
					    </form>
 </body>