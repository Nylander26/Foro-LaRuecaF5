<?php
    session_start();

    if(!$_SESSION["usuario"]){
        header("Location: login.php");
    }
    include("config/top.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Hilo</title>
    <link rel="stylesheet" href="./styles/hilo.css">
</head>
<body>

<!--Cuadro de Texto para compartir publicaciones -->

<?php $idTema= $_POST['newHilo'] ?? null; ?>
    <div class="container-all">
        <div class="login-box">
            <div class="container-logo">
                <img src="./img/logo1.png" alt="logo" class="logo">
            </div>
            <h2>Hilo</h2>
            <form action="" method="POST" class="container-form" autocomplete="off">
                <div class="user-box">
                    <input type="text" name="descHilo"><br>
                    <label>Descripcion:</label>
                </div>
                <div class="user-box">
                    <textarea name="contHilo" id="" cols="40" rows="8" placeholder="¿Qué estás pensando?"></textarea>
                </div>
                <br>
                <input type="hidden" name="new" value="<?php echo $idTema; ?>">
                <input type="submit" name="share" value="Compartir" class="btn">
                <input type="submit" value="Volver a Temas" class="btn" name="volver">
            </form>
        </div>
    </div>

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    
    <?php
        $idUsuario=$_SESSION["id"];
        //print_r ($idUsuario);
        
        if(isset($_POST["share"])){
   
            require("config/config.php");
            $descHilo=$_POST['descHilo'];
            $conHilo = $_POST['contHilo'];
            $idTemaHilo= $_POST["new"];
            $insertar = $conexion->query("INSERT INTO hilos (hilos, contHilo, idUsuario, idTemas) VALUES ('$descHilo', '$conHilo', '$idUsuario', '$idTemaHilo')");
            header("Location: index.php?id=$idUsuario");
        }
        
        if(isset($_POST["volver"])){
            header("Location: index.php?id=$idUsuario");
        }
    ?>
    <br>
</body>
</html>