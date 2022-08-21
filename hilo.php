<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    session_start();

    if(!$_SESSION["usuario"]){
        header("Location: login.php");
    }
    include("config/top.php");
?>
<!--Cuadro de Texto para compartir publicaciones -->
    <form action="" method="POST">
    <input type="text" name="descHilo" placeholder="Descripción"><br>
        <textarea name="contHilo" id="" cols="50" rows="8" placeholder="¿Qué estás pensando?"></textarea>
        <br>
        <input type="submit" name="share" value="Compartir">
    </form>

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    
    <?php
        $idUsuario = $_SESSION["id"];
        //print_r ($idUsuario);
        
   if(isset($_POST["share"])){
            
            require("config/config.php");
            $descHilo=$_POST['descHilo'];
            $conHilo = $_POST["contHilo"];

            $insertar = $conexion->query("INSERT INTO hilos (hilos, contHilo, idUsuario, idTemas) VALUES ('$descHilo', '$conHilo', '$idUsuario', '$idUsuario')");
        }
        print_r($_SESSION["id"]);
    ?>
    <a href="index.php?id=<?php echo $_SESSION['id']; ?>">home</a>
    <br>
</body>
</html>