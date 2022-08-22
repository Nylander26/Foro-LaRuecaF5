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
    <link rel="stylesheet" href="./styles/index.css">
    <title>Inicio</title>
</head>
<body>
    
    <!--Definir Usuario en caso de loguearse de manera exitosa y de ser exitoso el login se muestra el cuadro de publicacion-->
    <?php

        if(isset($_SESSION["usuario"])){
            require("config/config.php");
            include("config/top.php"); 

            if($_SESSION["id"] === 1 || $_SESSION["usuario"] === "admin@gmail.com"){ ?>

                <div class="container-all">
                    <div class="login-box">
                        <div class="container-logo">
                            <img src="./img/logo1.png" alt="logo" class="logo">
                        </div>
                        <h2>Crear Tema</h2>
                        <form action="" method="post" autocomplete="off" class="container-form">
                            <div class="user-box">
                                <input type="text" name="titulo" required>
                                <label>Titulo</label> 
                            </div>
                            <div class="user-box">
                                <input type="text" name="descripcion" required>
                                <label>Descripcion</label>
                            </div>
                            <div class="user-box">
                                <input type="text" name="contenido" required>
                                <label>Contenido</label>
                            </div>
                            <input type="submit" value="Crear Tema" name="crear" class="btn">
                        </form>
                    </div>
                </div>
            <?php 
            
            if(isset($_POST["crear"])){
                require("config/config.php");
                $titulo = $_POST["titulo"];
                $descripcion = $_POST["descripcion"];
                $contenido = $_POST["contenido"];

                $insertarTema = $conexion->query("INSERT INTO temas (titulo, descripcion, contenido, usuario, fecha) VALUES ('$titulo', '$descripcion', '$contenido', 'Admin', now())");

                if($insertarTema){
                    echo '<script>alert("Se ha creado el tema con exito.")</script>';
                }
            }
                
        } 
            if($_SESSION["estado"] === "activo"){   
    ?> 
    <br><br>
    <?php

        require("config/config.php");

        $mensajes = $conexion->query("SELECT * FROM temas ORDER BY id asc");
        while ($row = $mensajes->fetch_assoc()) { 
            
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
            if(isset($_POST["idTema"])) {
                include ('temas.php');
            }
        ?>
    </div>
    <br>
    <?php } ?>

<!--Si el usuario no esta logueado no se muestra el cuadro de texto para publicaciones ni se muestran las publicaciones realizadas-->
<?php } else {
        echo "El usuario " .$_SESSION['usuario'] . " está inactivo. <br> Te ofrecemos varias opciones: <br><br>";
        echo "<a href='login.php'>Intenta con un nuevo usuario</a><br>";
        echo "<a href='register.php'>Registrate de nuevo (no podrás utilizar el mismo nombre de usuario.</a><br>";
        echo "<a href='reactivar.php'>Activa nuevamente tu usuario.</a><br>";
        session_destroy();
    }
        
    } else{
        echo "<script>alert('Debes loguearte o registrarte para continuar')</script>";
    }
    ?>
</body>
</html>