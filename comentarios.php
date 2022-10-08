<?php
session_start();

if(!$_SESSION["usuario"]){
    header("Location: login.php");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Comentario</title>
    <link rel="stylesheet" href="./styles/hilo.css">
</head>
<body>

    <?php $idHilo= $_POST['newComent'] ?? null; ?>
    <div class="container-all">
        <div class="login-box">
            <div class="container-logo">
                <img src="./img/logo1.png" alt="logo" class="logo">
            </div>
            <h2>Comentario</h2>
            <form action="" method="POST" class="container-form" autocomplete="off">
                <div class="user-box">
                    <textarea name="comentHilo" id="" cols="40" rows="8" placeholder="Ingresa aquí tu comentario..."></textarea>
                </div>
                <br>
                <input type="hidden" name="new" value="<?php echo $idHilo; ?>">
                <input type="submit" name="share" value="Comentar" class="btn">
                <input type="submit" value="Volver a Temas" class="btn" name="volver">
            </form>
        </div>
    </div>

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    
    <?php
        $idUsuario=$_SESSION["id"];
        
        if(isset($_POST["share"])){
        
            require("config/config.php");
            $comentHilo = $_POST['comentHilo'];
            $idHiloComent= $_POST["new"];
            $insertar = $conexion->query("INSERT INTO comentarios (comentario, idHilo, idUsuario) VALUES ('$comentHilo', '$idHiloComent', '$idUsuario')");
            header("Location: index.php?id=$idUsuario");
        }

        if(isset($_POST["volver"])){
            header("Location: index.php?id=$idUsuario");
        }
    ?>
    <br>
</body>
</html>