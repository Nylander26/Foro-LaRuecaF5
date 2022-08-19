<!--Inicio de Sesion PHP-->

<?php
session_start();
?>

<!--Formato HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/foryou.css">
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

    <br><br>

    <!--Cuadro de Texto para compartir publicaciones-->
    <form action="" method="POST">
        <textarea name="mensaje" id="" cols="50" rows="8" placeholder="Que estas pensando?"></textarea>
        <br>
        <input type="submit" name="share" value="Compartir">
    </form>

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    <?php
        
        if(isset($_POST["share"])){
            
            require("config/config.php");

            $share = $_POST["mensaje"];

            $insertar = $conexion->query("INSERT INTO publicaciones (mensaje, usuario, fecha) VALUES ('$share', '".$_SESSION['id']."', now())");
        }
    ?>
    <br>

    <!--Mostrar publicaciones almacenadas anteriormente y mostrando el nombre de usuario-->
    <?php

        require("config/config.php");

        $mensajes = $conexion->query("SELECT * FROM publicaciones ORDER BY id desc");
        while ($row = $mensajes->fetch_assoc()){ 
            
            $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['usuario']."'");
            $rowUser = $usuarioName->fetch_assoc();
            ?>

            <div>
                <div><?php echo $row["mensaje"]; ?></div>
                <div><a href="perfil.php?id=<?php echo $row['usuario']; ?>"><?php echo $rowUser["usuario"]; ?></a></div>
            </div>
            <br>

        <?php } ?>

        <!--Si el usuario no esta logueado no se muestra el cuadro de texto para publicaciones ni se muestran las publicaciones realizadas-->
        <?php

         } else{
            echo "<a href='login.php'>Debes loguearte</a> o <a href='register.php'>Debes registrarte</a>";
    }
    }
    else 
    {
        echo "El usuario " .$_SESSION['usuario'] . " está inactivo. <br> Te ofrecemos varias opciones: <br><br>";
        echo "<a href='login.php'>Intenta con un nuevo usuario</a><br>";
        echo "<a href='register.php'>Registrate de nuevo (no podrás utilizar el mismo nombre de usuario.</a><br>";
        echo "<a href='reactivar.php'>Activa nuevamente tu usuario.</a><br>";
        session_destroy();
        
    }
    ?>
</body>
</html>