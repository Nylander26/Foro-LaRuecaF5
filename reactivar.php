<?php 
?>
<!--Formato HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reactivación de Usuario</title>
    <link rel="stylesheet" href="./styles/reactivar.css">
</head>
<body>
    <div class="container-all">
        <div class="login-box">
            <div class="container-logo">
                <img src="./img/logo1.png" alt="logo" class="logo">
            </div>

            <h2>Reactivar Usuario</h2>

            <form class="container-form" autocomplete="off" method="POST">
                <div class="user-box">
                    <input type="email" name="email" required="">
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" name="pass" required="">
                    <label>Password</label>
                </div>
                <input type="submit" value="Reactivar" name="reactivar" class="btn">
            </form>
        </div>
    </div>

    <!--Recoleccion de datos de registro, control de clonacion de usuarios y redireccion a la pagina de login-->
    <?php

        if(isset($_POST["reactivar"])){

            require("config/config.php");
            $email = $_POST["email"];
            $pass = $_POST["pass"];

                $reactivacion = $conexion->query("UPDATE usuarios SET estado = 'activo' WHERE  email = '$email' AND clave = '$pass'");
    
                if($reactivacion){
                    echo '<script>alert("El usuario ya se encuentra activo de nuevo... DISFRUTA!!")</script>';
                    echo '<script>window.location.href="index.php"</script>';
                }
            }
            
    ?>
</body>
</html>