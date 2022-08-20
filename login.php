<!--Inicio de Sesion-->

<?php
session_start();
if(isset($_SESSION["usuario"])){

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
    <title>Login</title>
    <link rel="stylesheet" href="./styles/loginCode.css">
</head>
<body>
    <div class="container-all">
        <div class="login-box">
            <div class="container-logo">
                <img src="./img/logo1.png" alt="logo" class="logo">
            </div>
            <h2>Login</h2>
            <form class="container-form" autocomplete="off" method="POST">
            <div class="user-box">
                <input type="email" name="email" required="">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="pass" required="">
                <label>Password</label>
            </div>
                <input type="submit" value="Login" name="login" class="btn">
            </form>
        </div>
        <hr>
        <div class="login-box">
            <div class="container-logo">
                <img src="./img/logo1.png" alt="logo" class="logo">
            </div>
            <h2>Registro</h2>
            <form class="container-form" autocomplete="off" method="POST">
                <div class="user-box">
                    <input type="email" name="email" required="">
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="text" name="user" required="">
                    <label>Username</label>
                </div>
                <div class="user-box">
                    <input type="password" name="pass" required="">
                    <label>Password</label>
                </div>
              <input type="submit" value="Registrarse" name="reg" class="btn">
            </form>
        </div>
    </div>

    <!--Logica Registro-->
    
    <?php

        if(isset($_POST["reg"])){

            require("config/config.php");
            $user = $_POST["user"];
            $email = $_POST["email"];
            $filtroEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
            $pass = $_POST["pass"]; 

            $userPubli = $conexion->query("SELECT * FROM usuarios WHERE usuariopublico = '$user'");
            $consulta = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$user'");
            $consultaEmail = $conexion->query("SELECT * FROM usuarios WHERE email = '$email'");
            $contar = $consulta->num_rows;
            $contarEmail = $consultaEmail->num_rows;
            
            if($contar > 0){

                echo '<script>alert("Ya existe un usuario con ese nombre.")</script>';

            } elseif($contarEmail > 0){

                echo '<script>alert("Ya existe un correo con ese nombre.")</script>';

            } else{

                $insertar = $conexion->query("INSERT INTO usuarios (usuario, email, clave, fecha, usuariopublico) VALUES('$user', '$email', '$pass', now(), '$user')");
    
                if($insertar){
                    echo '<script>alert("Te has registrado correctamente.")</script>';
                }
            }
        }
    ?>

    <!--Logica Login-->

    <?php

        if(isset($_POST["login"])){
            require ("config/config.php");

            $email = $_POST["email"];
            $pass = $_POST["pass"];

            $validar = $conexion->query("SELECT * FROM usuarios WHERE email = '$email' AND clave = '$pass'");
            $status=$conexion->query("SELECT `estado` FROM usuarios WHERE `usuario` = '$email' AND  `clave` = '$pass'");
            $contar = $validar->num_rows;
            $dato = $validar->fetch_assoc();

            
            if($contar === 1)
            
            {
                $_SESSION["usuario"] = $email;
                $_SESSION["id"] = $dato["id"];
                $_SESSION["estado"] = $dato["estado"];
                //print_r($dato);
                header("Location: index.php");
            }
            else
            {
                echo '<script>alert("El usuario no existe o los datos son incorrectos")</script>';
            }
        }
    ?>
</body>
</html>
