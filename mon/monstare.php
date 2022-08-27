<?php
    include_once '../header.php';
if(isset($_SESSION["useruid"])){
    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
}
?>
<?php   
   if($_SESSION["userrolid"]==2){
    echo "<h1>aqui conectaras monstruos y areas. </h1>";
    echo "<ul>";
    echo "<li><a href='../listar.php'>Monstruos y areas</a></li>";
    echo "<li><a href='agregarMonstruo.php'>Agregar Monstruo</a></li>";
    echo "<li><a href='agregarArea.php'>Agregar Area</a></li>";
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
			                    <th style="vertical-align: middle;">Area</th>
			                    <th style="vertical-align: middle;">Nombre</th>
                          <th><a href='new_monstare.php'> <button type='button' class='btn btn-info'>Nuevo vinculo</button></a> </th>
	                     	</tr>
	                    </thead>
                        <?php
                        include_once '../includes/dbhinc.php';
                        $sql = "SELECT * FROM monsterarea INNER JOIN area ON monsterarea.AreaID = area.AreaID INNER JOIN monster ON monsterarea.MonsterID = monster.MonsterID WHERE monster.Eliminado=0 AND monsterarea.Eliminado=0";
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
                            echo "<td>";        
                            echo "<a href='./includemon/delete_monarea.php?MonsterAreaID=".$row['MonsterAreaID']."'><button type='button' class='btn btn-danger'>Eliminar</button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }

                        ?>
	</table>
</body>
</html>


<?php
    include_once '../pie.php';
?>