<!--Inicio de Sesion PHP-->

<?php
session_start();
?>

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
            require("config/config.php");
            include("config/top.php"); 
        ?> 
    <br><br>

    <!--Cuadro de Texto para compartir publicaciones
    <form action="" method="POST">
        <textarea name="mensaje" id="" cols="50" rows="8" placeholder="Que estas pensando?"></textarea>
        <br>
        <input type="submit" name="share" value="Compartir">
    </form>-->

    <!--Almacenar publicaciones mediante la funcionalidad del boton SHARE-->
    <?php
        
        /*if(isset($_POST["share"])){
            
            require("config/config.php");

            $share = $_POST["mensaje"];

            $insertar = $conexion->query("INSERT INTO publicaciones (mensaje, usuario, fecha) VALUES ('$share', '".$_SESSION['id']."', NOW())");
        }*/
    ?>
    <br>

    <!--Mostrar publicaciones almacenadas anteriormente y mostrando el nombre de usuario-->
    <?php

        /*require("config/config.php");

        $mensajes = $conexion->query("SELECT * FROM publicaciones ORDER BY id desc");
        while ($row = $mensajes->fetch_assoc()){ 
            
            $usuarioName = $conexion->query("SELECT usuariopublico FROM usuarios WHERE id = '".$row['usuario']."'");
            $rowUser = $usuarioName->fetch_assoc();
            ?>

            <div>
                <div><?php echo $row["mensaje"]; ?></div>
                <div><a href="perfil.php?id=<?php echo $row['usuario']; ?>"><?php echo $rowUser['usuariopublico']; ?></a></div>
                <div><?php echo $row['fecha']; ?></div>
            </div>
            <br>

        <?php } ?>

        <!--Si el usuario no esta logueado no se muestra el cuadro de texto para publicaciones ni se muestran las publicaciones realizadas-->
        <?php

         } else{
        echo "<a href='login.php'>Debes loguearte</a> o <a href='register.php'>Debes registrarte</a>";*/
    }
    ?>

    <!--Muestra la tabla de temas creados-->

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
            
            <table style="width: 100%; text-align: center;">
                <tr>
                    <th>Titulo</th>
                    <th>Fecha</th>
                    <th>Respuestas</th>
                    <th>Descripcion</th>
                </tr>
                <tr>
                    <td><?php echo $row["titulo"]; ?></td>
                    <td><?php echo $newDate; ?></td>
                    <td><?php echo $row["respuestas"]; ?></td>
                    <td><?php echo $row["mensaje"]; ?></td>
                    <td><a href="temas.php?id=<?php echo $row['titulo']; ?>">Ver Tema</td>
                </tr>
            </table>   
       <?php } ?>
<?php //print_r($_SESSION); ?>
</body>
</html>