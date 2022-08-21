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
</head>
<body>


<!--Cuadro de Texto para compartir publicaciones -->

<?php $idHilo= $_POST['newComent'] ?? null; ?>
    <form action="" method="POST">
        <textarea name="comentHilo" id="" cols="50" rows="8" placeholder="Ingresa aquí tu comentario"></textarea>
        <br>
        <input type="hidden" name="new" value="<?php echo $idHilo; ?>">
        <input type="submit" name="share" value="Comentar">
        
    </form>
    <a href="index.php?id=<?php echo $_SESSION['id']; ?>">
        <input type="submit" value="Volver a Temas"></a>

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    
    <?php
        $idUsuario=$_SESSION["id"];
        
        
   if(isset($_POST["share"])){
   
            require("config/config.php");
            $comentHilo = $_POST['comentHilo'];
            $idHiloComent= $_POST["new"];
            $insertar = $conexion->query("INSERT INTO comentarios (comentario, idHilo, idUsuario) VALUES ('$comentHilo', '$idHiloComent', '$idUsuario')");
        }
    ?>
    <br>


</body>
</html>