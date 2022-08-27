
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
<?php
 include_once '../includes/dbhinc.php';
 include_once '../includes/functionsinc.php';


 $request = ConsultarMonstruo($conn, $_GET['MonsterID']);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 </head>
 <body>
						      <?php
						     	//define( 'RUTA_HTTP', 'http://www.duanealiaga.com/cientifica/' );
						     	define( 'RUTA_HTTP', 'http://localhost/root' );
						      $monstersprite = RUTA_HTTP.'/img/monsters/'.$_GET['MonsterID'].'.png';
						      if (@getimagesize($monstersprite)) {
						     	   $monstersprite=$monstersprite;
							   }
							        ?>
							   <img src="<?php echo $monstersprite; ?>" alt="Imagen">
 <form method="post" action="./includemon/monedsav.php?id=<?php echo $_GET['MonsterID'];?>" class="register">
                            <div>
					        	<input style="border-radius: 5px" type="hidden" name="id" autocomplete="on" value="<?php echo $request[0]; ?>" required>
					        </div>
                            <div>
					        	<label>Nombre Monstruo: </label>
					        	<input style="border-radius: 5px" type="text" name="name" autocomplete="on" value="<?php echo $request[1]; ?>" required>
					        </div>
					        <div>
					        	<label>Ataque: </label>
					        	<input style="border-radius: 5px" type="text" name="atk" autocomplete="on" value="<?php echo $request[2]; ?>" required>
					        </div>
					        <div>
					        	<label>Defensa: </label>
					        	<input style="border-radius: 5px" type="text" name="def" autocomplete="on" value="<?php echo $request[3]; ?>" required>
					        </div>
                            <div>
					        	<label>Vida: </label>
					        	<input style="border-radius: 5px" type="text" name="hp" autocomplete="on" value="<?php echo $request[4]; ?>" required>
					        </div>
                            <div>
					        	<label>Velocidad: </label>
					        	<input style="border-radius: 5px" type="text" name="spd" autocomplete="on" value="<?php echo $request[5]; ?>" required>
					        </div>
					       	<br>
					        <div><input type="submit" style="border-radius: 5px; font-size:15px;" class="btn btn-success" name="submit" value="Enviar"></div>
					    </form>
<!---------------------------------------------->
                                <div class="pull-left image">
							        <form action="./includemon/subir_foto.php?id=<?php echo $_GET['MonsterID'];?>" method=post enctype="multipart/form-data">
							        	<input name="usuario" value="<?php echo $_Get["MonsterID"];?>" style="display: none;"><br>
										<font color="black"><div align='center'><input type="file" name="imagen"><br>
										<input type="submit" value="Cambiar foto (.png)"></div><br></font>
									</form>
							    </div>
 </body>