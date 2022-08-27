<?php
    include_once '../header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<h1>aqui podra agregar monstruos al juego. </h1>";
    echo "<ul>";
    echo "<li><a href='../listar.php'>Monstruos y areas</a></li>";
    echo "<li><a href='agregarArea.php'>Agregar Area</a></li>";
    echo "<li><a href='monstare.php'>Conectar Monstruos y areas </a></li>";
    echo "</ul>";
   } else {
   header("location: ../index.php");
   exit();}
   ?>
<!DOCTYPE html>
<html>
    <head>
        <title>mostrar datos</title>
        <style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 100%;
}

td {
  text-align: center;
}
</style>

   </head>
   <body>
    <br>
    <table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Nombre</th>
                          <th style="vertical-align: middle;">Sprite</th>
			                    <th style="vertical-align: middle;">Ataque</th>
			                    <th style="vertical-align: middle;">Defensa</th>
			                    <th style="vertical-align: middle;">Vida</th>
			                    <th style="vertical-align: middle;">Velocidad</th>
	                     	</tr>
	                    </thead>
                        <?php
                        define( 'RUTA_HTTP', 'http://localhost/root' );
                        include_once '../includes/dbhinc.php';
                        $sql = "SELECT * FROM monster WHERE monster.Eliminado=0";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['MonsterID'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['MonsterName'] ;echo "</td>";
                            $monstersprite = RUTA_HTTP.'/img/monsters/'.$row['MonsterID'].'.png';
                            if (@getimagesize($monstersprite)) {
                                $monstersprite=$monstersprite;
                           }
                             echo "<td><img src='$monstersprite' alt='Imagen'></td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Attack'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Defense'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['HP'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Speed'] ;echo "</td>"; 
                            echo "<td>";                        		
                            echo "<a href='modifmonst.php?MonsterID=".$row['MonsterID']."'> <button type='button' class='btn btn-success'>Actualizar</button></a>";
                            echo "<a href='./includemon/delete_mon.php?MonsterID=".$row['MonsterID']."'><button type='button' class='btn btn-danger'>Eliminar</button></a>";
                            $last = $row['MonsterID']+1;
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
	</table>
  <?php
			                    echo "<th>";
                          echo "<a href='new_monst.php?MonsterID=".$last."'> <button type='button' class='btn btn-info'>Nuevo</button></a></th>";
                          ?>
</body>
</html>


<?php
    include_once '../pie.php';
?>