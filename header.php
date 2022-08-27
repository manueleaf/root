<?php
session_start();
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
  float: right;
}

.container{
        width: 80%;
        margin: 0 auto; /* Center the DIV horizontally */
    }
.fixed-header, .fixed-footer{
        width: 100%;
        position: fixed;        
        background: #333;
        padding: 0px 0;
        color: #fff;
    }
.fixed-header{
        top: 0;
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
  <div class="fixed-header">
    <div class="container">
        <nav>
              <ul>
                  <li><a href="/root/index.php">Home</a></li>
                  <li><a href="/root/info.php">Informacion</a></li>
                  <?php
                   if (isset($_SESSION["useruid"])){
                    echo "<li><a href='/root/dex.php'>Jugar</a></li>";
                        if ($_SESSION["userrolid"]==2){
                        echo "<li><a href='/root/listar.php'>Monstruos</a></li>";
                    }
                    echo "<li><a href='/root/includes/logoutinc.php'>Log out</a></li>";
                    echo "<p>Bienvenido " . $_SESSION["useruid"] . "</p>";
                   } 
                   else{
                    echo "<li><a href='signup.php'>Sign up</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                    }
                    ?>
              </ul>
        </nav>
    </div>
  </div>

