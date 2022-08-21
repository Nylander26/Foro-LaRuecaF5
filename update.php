<!--IMPORTANTE MODIFICAR LA BBDD PARA QUE SE ACTUALICE AUTOMATICAMENTE AL MOMENTO DE ACTUALIZAR LOS DATOS YA QUE SI NO EL LOGIN NO FUNCIONARA-->


<!--Inicio de Sesion-->
<?php

session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
}

?>

<!--Formato HTML-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Perfil</title>
</head>
<body>
    
    <!--Estructura de control para validar si el usuario es el correcto para modificar el perfil-->
    <?php 
        if($_GET["id"] == $_SESSION["id"]){
            if(isset($_GET["id"])){ 
                require("config/config.php");
                include("config/top.php");
                $solicitar = $conexion->query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
                $row = $solicitar->fetch_assoc();
       ?>

        <?php if($_GET["id"] == $_SESSION["id"]){ ?>
            <?php require("config/config.php"); ?>

            <form action="" method="post">
                Nombre y Apellido:<br>
                    <input type="text" name="nameUpdate" value="<?php echo $row['nombrereal'] ?>"><br>
                Nombre de Usuario:<br>
                    <input type="text" name="userUpdate" value="<?php echo $row['usuario'] ?>"><br>
                Contraseña:<br>
                    <input type="password" name="passUpdate" value="<?php echo $row['clave'] ?>"><br>
                Email:<br>
                    <input type="email" name="emailUpdate" value="<?php echo $row['email'] ?>"><br>
                <input type="submit" value="Modificar" name="update">
            </form>
            <?php } ?>

            <?php
                $nameUpdate = $_POST["nameUpdate"] ?? null;
                $userUpdate = $_POST["userUpdate"] ?? null;
                $passUpdate = $_POST["passUpdate"] ?? null;
                $emailUpdate = $_POST["emailUpdate"] ?? null;
                $filtroEmailUpdate = filter_var($emailUpdate, FILTER_SANITIZE_EMAIL);
                require ("config/config.php");

                if(isset($_POST["update"])){

                    if(isset($nameUpdate)){
                        $rutaNombre = $conexion->query("UPDATE usuarios SET nombrereal = '".$nameUpdate."' WHERE id = '".$_GET['id']."'");
                    } 

                    if(isset($userUpdate)){
                        $rutaUsuario = $conexion->query("UPDATE usuarios SET usuario = '".$userUpdate."' WHERE id = '".$_GET['id']."'");
                        unset($_SESSION["usuario"]);
                        $_SESSION["usuario"] = $userUpdate;
                    } 
                    
                    if(isset($passUpdate)){
                        $rutaPass = $conexion->query("UPDATE usuarios SET clave = '".$passUpdate."'WHERE id = '".$_GET['id']."'");
                    } 
                    
                    if(isset($emailUpdate)){
                        $rutaEmail = $conexion->query("UPDATE usuarios SET email = '".$filtroEmailUpdate."' WHERE id = '".$_GET['id']."'");
                    }
                    echo "Los cambios se han realizado con exito!";
                    //header("Location: update.php?id=".$_GET["id"]."");
                }
                //print_r($_SESSION);
            ?>
            <?php } ?>
        <?php } ?>
</body>
</html>