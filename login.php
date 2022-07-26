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
</head>
<body>
    <h1>Login</h1><hr>
    <form action="" method="POST">
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
        $contar = $validar->num_rows;
        $dato = $validar->fetch_assoc();

        if($contar == 1){
            $_SESSION["usuario"] = $user;
            $_SESSION["id"] = $dato["id"];
            header("Location: index.php");
        } else{
            echo "El usuario o contraseña no son validos o no existen.";
        }
    } 
    ?>
</body>
</html>