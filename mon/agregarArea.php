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
    echo "<li><a href='agregarMonstruo.php'>Agregar Monstruo</a></li>";
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
    <th> <a href='modifarea.php'> <button type='button' class='btn btn-info'>Nueva area</button></a></th>
    <table id="TablaEntidad" class="table table-bordered table-hover dataTable no-footer" width="100%">
	                    <thead>
	                      	<tr>                      
		                    	<th>ID</th>                    
			                    <th style="vertical-align: middle;">Area</th>
	                     	</tr>
	                    </thead>
                        <?php
                        include_once '../includes/dbhinc.php';
                        $sql = "SELECT * FROM area";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<tr>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['AreaID'] ;echo "</td>";
                            echo "<td style='vertical-align: middle;'>"; echo $row['AreaName'] ;echo "</td>";
                            echo "</tr>";
                        }

                        ?>
	</table>
</body>
</html>


<?php
    include_once '../pie.php';
?>