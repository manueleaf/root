<?php
    include_once 'header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<h1>Lista de conexion Monstruo-Area y estadisticas. </h1>";
    echo "<ul>";
    echo "<li><a href='mon/agregarMonstruo.php'>Agregar Monstruo</a></li>";
    echo "<li><a href='mon/agregarArea.php'>Agregar Area</a></li>";
    echo "<li><a href='mon/monstare.php'>Conectar Monstruos y areas </a></li>";
    echo "</ul>";
   } else {
   header("location: ./index.php");
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
			                    <th style="vertical-align: middle;">Area</th>
			                    <th style="vertical-align: middle;">Nombre</th>
			                    <th style="vertical-align: middle;">Ataque</th>
			                    <th style="vertical-align: middle;">Defensa</th>
			                    <th style="vertical-align: middle;">Vida</th>
			                    <th style="vertical-align: middle;">Velocidad</th>
	                     	</tr>
	                    </thead>
                        <?php
                        include_once './includes/dbhinc.php';
                        $sql = "SELECT * FROM monsterarea INNER JOIN area ON monsterarea.AreaID = area.AreaID INNER JOIN monster ON monsterarea.MonsterID = monster.MonsterID WHERE monster.eliminado=0";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['MonsterAreaID'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['AreaName'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['MonsterName'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Attack'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Defense'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['HP'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['Speed'] ;echo "</td>";  
                            echo "</tr>";
                        }

                        ?>
	</table>
</body>
</html>


<?php
    include_once 'pie.php';
?>