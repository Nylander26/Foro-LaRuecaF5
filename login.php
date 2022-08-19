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
    <link rel="stylesheet" href="./styles/loginCode.css">
</head>
<body>
    <div class="login-box">
        <div class="container-logo">
            <img src="./img/logo1.png" alt="logo" class="logo">
        </div>
        <h2>Login</h2>
        <form class="container-form">
        <div class="user-box">
            <input type="text" name="user" required="">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Password</label>
        </div>
        <a href="index.php" name="login" >
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Login
        </a>
        <a href="register.php" name="register">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            Registro
        </form>
    </div>    
</body>
</html>

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