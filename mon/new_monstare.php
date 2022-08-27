<?php
    include_once '../header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<ul>";
    echo "<li><a href='monstare.php'>Regresar</a></li>";
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
 <form method="post" action="./includemon/monareadd.php" class="register">

 <?php
                        include_once '../includes/dbhinc.php';
                        $sql = "SELECT * FROM monster WHERE monster.eliminado=0";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        echo '<form method="post" action="/includemon/monstareadd.php" class="register">';
						echo '<label>Nombre Monstruo: </label>';
						echo '<select type="text" name="monstruo">';
						while($row=mysqli_fetch_assoc($result))
                        {
							$MonsterName=$row['MonsterName'];
                            echo "<option value='$MonsterName'>$MonsterName</option>";
							}
							echo '</select>';
                        $sql = "SELECT * FROM area";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        echo '<label>Nombre Area: </label>';
						echo '<select type="text" name="area">';
						while($row=mysqli_fetch_assoc($result))
                        {
							$AreaName=$row['AreaName'];
                            echo "<option value='$AreaName'>$AreaName</option>";
							}
							echo '</select>';
							?>
					       	<br>
					        <div><input type="submit" style="border-radius: 5px; font-size:15px;" class="btn btn-success" name="submit" value="Enviar"></div>
					    </form>
 </body>