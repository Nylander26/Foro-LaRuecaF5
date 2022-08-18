<!--Inicio de Sesion-->
<?php
session_start();

if(!isset($_SESSION["usuario"])){
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
    <title>Perfil</title>
</head>
<body>
    
    

    <!--Solicitud para mostrar el perfil logueado incluyendo nombre de perfil, fecha de creacion de cuenta y foto de perfil-->
    <?php if(isset($_GET["id"])){ 

    require("config/config.php");
    $solicitar = $conexion->query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
    $row = $solicitar->fetch_assoc();
    $id= $row['id'];
    ?>

    <?php include("config/top.php"); ?> <br><br>

            Perfil de: <?php echo $row['usuario'];?> <br><br>

            Registrado desde: <?php echo $row['fecha'];?> <br><br>

            Estado de la cuenta: <?php echo $row['estado']; ?> <br><br>

            Desactivar mi cuenta:<form action="" method="POST">
            <input type="hidden" name="id" value= "<?php echo $id ?>"><br>
            <input type="submit" name="desactivar" value="Desactivar mi usuario"></form>
            <?php 
    
        if(isset($_POST["desactivar"])){
            $desactivar = $conexion->query("UPDATE usuarios SET estado = 'inactivo' WHERE  id = $id ");
                echo "Has cambiado el estado de tu cuenta a Inactivo. Tranquilo, aún podrás utilizar forYou (incluso puedes volver con este mismo usuario).";
            }
            ?>
            Foto de perfil: <img src="<?php echo $row['imagen'];?>" width="100"><br><br>
            
            <!--Estructura de control en caso de que otro usuario fuera del que este logueado no pueda subir imagenes al perfil actualmente logueado-->
            <?php
                if($_GET["id"] == $_SESSION["id"]){ ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="imagen">
                <input type="submit" value="Subir" name="subir">
            </form>
            <?php } ?>
            
            <!--Protocolo para subir imagenes y almacenarlas en carpetas de trabajo del servidor y la BD-->
            <?php

                if(isset($_POST["subir"])){
                    $ruta = "fotodeperfil/";
                    $fichero = $ruta.basename($_FILES["imagen"]["name"]);
                    $rut = $ruta.$_GET["id"].".jpg";

                    if(move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta.$_GET["id"].".jpg")) {
                        
                        require("config/config.php");

                        $insertar = $conexion->query("UPDATE usuarios SET imagen = '$rut' WHERE id = '".$_GET['id']."'");
                        header("Location: perfil.php?id=".$_GET["id"]."");
                    };
                }

            ?>
            <br><br><br><br>

            <!--Muestra las publicaciones realizadas por el perfil logueado en su perfil-->
            <?php

                require("config/config.php");

                $mensajes = $conexion->query("SELECT * FROM publicaciones WHERE usuario = '".$_GET['id']."' ORDER BY id desc");
                while ($row = $mensajes->fetch_assoc()){ 
                    
                    $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['usuario']."'");
                    $rowUser = $usuarioName->fetch_assoc();
                    ?>

                    <div>
                        <div><?php echo $row["mensaje"]; ?></div>
                        <div><a href="perfil.php?id=<?php echo $row['usuario']; ?>"><?php echo $rowUser["usuario"]; ?></a></div>
                    </div>
                    <br>

            <?php } ?>
       <?php } ?>

</body>
</html>