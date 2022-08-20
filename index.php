<?php
session_start();

if(!$_SESSION["usuario"]){
    header("Location: login.php");
}?>

<!--Formato HTML-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    
    <!--Definir Usuario en caso de loguearse de manera exitosa y de ser exitoso el login se muestra el cuadro de publicacion-->
    <?php
        if(isset($_SESSION["usuario"])){
            if($_SESSION["estado"] === "activo"){
                require("config/config.php");
                include("config/top.php"); 
    ?> 
    <br><br>
    
    <!--Muestra la tabla de temas creados-->

    <table style="width: 100%; text-align: center;">
        <tr>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Respuestas</th>
            <th>Descripcion</th>
        </tr>
    <?php
        
        require("config/config.php");
        
        $temas = $conexion->query("SELECT * FROM publicaciones");

        while($row = $temas->fetch_assoc()){
            $date = $row["fecha"];
            $timestamp = strtotime($date); 
            $newDate = date("d-m-Y", $timestamp);
            $usuarioRow = $row["id"];
            $titulo = $conexion->query("SELECT * FROM publicaciones WHERE id = $usuarioRow ORDER BY id desc");
            $rowTitulo = $titulo->fetch_assoc();
            ?>
                <tr>
                    <td><?php echo $row["titulo"]; ?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo $row["respuestas"]; ?></td>
                    <td><?php echo $row["mensaje"]; ?></td>
                    <td><a href="temas.php?id=<?php echo $row['titulo']; ?>">Ver Tema</td>
                </tr>
                <?php } ?>
            </table>   
    <?php
    
    }else {
        echo "El usuario " .$_SESSION['usuario'] . " está inactivo. <br> Te ofrecemos varias opciones: <br><br>";
            echo "<a href='login.php'>Intenta con un nuevo usuario</a><br>";
            echo "<a href='login.php'>Registrate de nuevo (no podrás utilizar el mismo nombre de usuario.</a><br>";
            echo "<a href='reactivar.php'>Activa nuevamente tu usuario.</a><br>";
            session_destroy();
        } 
    }
    ?>
</body>
</html>