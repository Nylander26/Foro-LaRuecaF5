<!--Inicio de Sesion-->

<?php
session_start();
if(isset($_SESSION["usuario"])){

    header("Location: foryou.php");
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
</head>
<body>
    <h1>Login</h1><hr>
    <form action method="POST">
        Usuario: <br>
        <input type="text" name="user"><br>
        Clave: <br>
        <input type="password" name="pass"><br>
        <input type="submit" name="login" value="Login"><a href="register.php" target="_blank">Registrese</a>
    </form>

    <!--Formato para validar inicios de sesion recuperando el id de MySQL y redireccionando a la pagina de inicio-->
    <?php

    if(isset($_POST["login"])){
        require ("config/config.php");

        $user = $_POST["user"];
        $pass = md5($_POST["pass"]);

        $validar = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$pass'");
        $status=$conexion->query("SELECT `estado` FROM usuarios WHERE `usuario` = '$user' AND  `clave` = '$pass'");
        $contar = $validar->num_rows;
        $dato = $validar->fetch_assoc();

        
        if($contar == 1)
        
        {
            $_SESSION["usuario"] = $user;
            $_SESSION["id"] = $dato["id"];
            $_SESSION["estado"] = $dato["estado"];
            header("Location: foryou.php");
        }
        else
        {
         echo "El usuario no existe o los datos son incorrectos";
        }
         
        
    }

    ?>
</body>
</html>