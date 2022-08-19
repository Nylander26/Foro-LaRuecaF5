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
    <link rel="stylesheet" href="./styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="divLogin">
    <img src="img/logo1.png" class="logo">
    <br>
    <div class="subDivLogin">
    <form action method="POST">
        <label>Usuario: </label>
        <input type="text" name="user"><br><br>
        <label>Clave: </label>
        <input type="password" name="pass"><br><br>
        <input class= "loginButton" type="submit" name="login" value="Login"><br><br>
        <a href="register.php" target="_blank">Registrese</a>
    </form>
    </div>
   <!--Formato para validar inicios de sesion recuperando el id de MySQL y redireccionando a la pagina de inicio-->
  <p class= "mensaje"> <?php

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
        //print_r( $dato["estado"]);
        header("Location: foryou.php");
    }
    else
    {
     echo "El usuario no existe o los datos son incorrectos";
    }
}

?>
</p>
    </div>

</body>
</html>