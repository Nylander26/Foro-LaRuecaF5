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
    <link rel="stylesheet" href="./styles/foryou.css">
    <title>Inicio</title>
</head>
<body>
    
    <!--Definir Usuario en caso de loguearse de manera exitosa y de ser exitoso el login se muestra el cuadro de publicacion-->
    <?php
    if ($_SESSION["estado"] == "activo")
    {
    if(isset($_SESSION["usuario"])){
    ?>

    <?php include("config/top.php"); ?>


   

    <!--Mostrar publicaciones almacenadas anteriormente y mostrando el nombre de usuario-->
    <?php

        require("config/config.php");

        $mensajes = $conexion->query("SELECT * FROM temas ORDER BY id asc");
        while ($row = $mensajes->fetch_assoc())
    { 
            
            $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['usuario']."'");
            $rowUser = $usuarioName->fetch_assoc();
            ?>

        <div class="divTema">

               <h3> <?php echo $row["titulo"]; ?> </h3>
               
               <h5><?php echo $row["descripcion"]; ?> </h5>
            
              <p>  <?php echo $row["contenido"]; ?> </p>
                
              <form action="" method="POST">
                <input type="hidden" name="idTema" value="<?php echo $row["id"]; ?>">
                <input type="submit" class= "inputTema" value="Ver hilos de <?php echo $row["titulo"]; ?>">
        </form>
        <?php 
if(isset($_POST["idTema"]))
{
    include ('temas.php');
}
        
         ?>
         
        
            </div>
           
            <br>
            
        <?php } ?>

        
        <!--Si el usuario no esta logueado no se muestra el cuadro de texto para publicaciones ni se muestran las publicaciones realizadas-->
        <?php

         } else{
            echo "<a href='login.php'>Debes loguearte</a> o <a href='register.php'>Debes registrarte</a>";
    }
    }
    else 
    {
        echo "El usuario " .$_SESSION['usuario'] . " está inactivo. <br> Te ofrecemos varias opciones: <br><br>";
        echo "<a href='login.php'>Intenta con un nuevo usuario</a><br>";
        echo "<a href='register.php'>Registrate de nuevo (no podrás utilizar el mismo nombre de usuario.</a><br>";
        echo "<a href='reactivar.php'>Activa nuevamente tu usuario.</a><br>";
        session_destroy();
        
    }
    ?>
</body>
</html>

<!--Definir Usuario en caso de loguearse de manera exitosa y de ser exitoso el login se muestra el cuadro de publicacion-->
<?php
        if(isset($_SESSION["usuario"])){
            if($_SESSION["estado"] === "activo"){
                require("config/config.php");
                include("config/top.php"); 
    ?> 
    <br><br>
    
    <!--Muestra la tabla de temas creados

    <table style="width: 100%; text-align: center;">
        <tr>
            <th>Titulo</th>
            <th>Fecha</th>
            <th>Respuestas</th>
            <th>Descripcion</th>
        </tr>-->
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