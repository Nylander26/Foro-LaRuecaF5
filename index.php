<?php
session_start();

if(!$_SESSION["usuario"]){
    header("Location: login.php");
}?>

<!--Formato HTML-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    
     <!--Definir Usuario en caso de loguearse de manera exitosa y de ser exitoso el login se muestra el cuadro de publicacion-->
     <?php
        if ($_SESSION["estado"] == "activo")
        {
        if(isset($_SESSION["usuario"])){
    ?>

    <?php include("config/top.php"); ?>

    <!--Mostrar publicaciones almacenadas anteriormente y mostrando el nombre de usuario-->
    <?php

        require("config/config.php");
        $mensajes = $conexion->query("SELECT * FROM temas ORDER BY id asc");

        while ($row = $mensajes->fetch_assoc()){ 
            
            $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['usuario']."'");
            $rowUser = $usuarioName->fetch_assoc(); ?>

            <div class="divTema">
                <h3> <?php echo $row["titulo"]; ?> </h3>
                <h5><?php echo $row["descripcion"]; ?> </h5>
                <p>  <?php echo $row["contenido"]; ?> </p>
                    
                <form action="" method="POST">
                    <input type="hidden" name="idTema" value="<?php echo $row["id"]; ?>">
                    <input type="submit" class= "inputTema" value="Ver hilos de <?php echo $row["titulo"]; ?>">
                </form>
            <?php 

                if(isset($_POST["idTema"])){
                    include ('temas.php');
                }
            ?>
            </div>
            <br>
        <?php } ?>

        <!--Si el usuario no esta logueado no se muestra el cuadro de texto para publicaciones ni se muestran las publicaciones realizadas-->
        <?php } else{
            echo "<a href='login.php'>Debes loguearte</a> o <a href='register.php'>Debes registrarte</a>";}
    } else {
        echo "El usuario " .$_SESSION['usuario'] . " está inactivo. <br> Te ofrecemos varias opciones: <br><br>";
        echo "<a href='login.php'>Intenta con un nuevo usuario</a><br>";
        echo "<a href='register.php'>Registrate de nuevo (no podrás utilizar el mismo nombre de usuario.</a><br>";
        echo "<a href='reactivar.php'>Activa nuevamente tu usuario.</a><br>";
        session_destroy();
    } ?>
</body>
</html>