<?php
    include_once '../header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<ul>";
    echo "<li><a href='agregarMonstruo.php'>Regresar</a></li>";
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
 <form method="post" action="./includemon/monadd.php?id=<?php echo $_GET['MonsterID'];?>" class="register" enctype="multipart/form-data">
                            <div>
					        	<label>Nombre Monstruo: </label>
					        	<input style="border-radius: 5px" type="text" name="name" autocomplete="on" placeholder="nombre" required>
					        </div>
					        <div>
					        	<label>Ataque: </label>
					        	<input style="border-radius: 5px" type="number" name="atk" autocomplete="on" placeholder="valor de ataque" required>
					        </div>
					        <div>
					        	<label>Defensa: </label>
					        	<input style="border-radius: 5px" type="number" name="def" autocomplete="on" placeholder="valor de defensa" required>
					        </div>
                            <div>
					        	<label>Vida: </label>
					        	<input style="border-radius: 5px" type="number" name="hp" autocomplete="on" placeholder="Vida" required>
					        </div>
                            <div>
					        	<label>Velocidad: </label>
					        	<input style="border-radius: 5px" type="number" name="spd" autocomplete="on" placeholder="Velocidad" required>
					        </div>
							<div>
							<input name="usuario" value="<?php echo $_GET["MonsterID"];?>" style="display: none;"><br>
										<font color="black"><div align='center'><input type="file" name="imagen"><br>
   							</div>
					       	<br>
					        <div><input type="submit" style="border-radius: 5px; font-size:15px;" class="btn btn-success" name="submit" value="Enviar"></div>
					    </form>
 </body>