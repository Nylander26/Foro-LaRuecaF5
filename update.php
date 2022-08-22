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
    <link rel="stylesheet" href="./styles/update.css">
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

            <div class="container-all">
                <div class="login-box">
                    <div class="container-logo">
                        <img src="./img/logo1.png" alt="logo" class="logo">
                    </div>
                    <h2>Modificar Perfil</h2>
                    <form action="" method="post" class="container-form" autocomplete="off">
                        <div class="user-box">
                            <label>Nombre y Apellido:</label><br>
                                <input type="text" name="nameUpdate" value="<?php echo $row['nombrereal'] ?>"><br>
                        </div>
                        <div class="user-box">
                            <label>Nombre de Usuario:</label><br>
                                <input type="text" name="userUpdate" value="<?php echo $row['usuario'] ?>"><br>
                        </div>
                        <div class="user-box">
                            <label>Contraseña:</label><br>
                                <input type="password" name="passUpdate" value="<?php echo $row['clave'] ?>"><br>
                        </div>
                        <div class="user-box">
                            <label>Email:</label><br>
                                <input type="email" name="emailUpdate" value="<?php echo $row['email'] ?>"><br>
                        </div>
                        <input type="submit" value="Modificar" name="update" class="btn">
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
                </div>
            </div>
        </div>
</body>
</html>