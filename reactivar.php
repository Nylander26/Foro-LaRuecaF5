<?php 
?>
<!--Formato HTML-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reactivación de Usuario</title>
</head>
<body>
    <h1>Reactivar Usuario</h1><hr>
    <form action="" method="POST">
        Usuario: <br>
            <input type="text" name="user"><br>
        Clave: <br>
            <input type="password" name="pass"><br>
         <!-- E-mail:<br>
            <input type="email" name="correo"><br>  -->
            <input type="submit" name="reactivar" value="Reactivar">
    </form>

    <!--Recoleccion de datos de registro, control de clonacion de usuarios y redireccion a la pagina de login-->
    <?php

        if(isset($_POST["reactivar"])){

            require("config/config.php");
            $user = $_POST["user"];
            $pass = $_POST["pass"];
            //$email= $_POST["correo"];

           // $consulta = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$user' AND clave = '$pass'");
           // $contar = $consulta->num_rows;

                $reactivacion = $conexion->query("UPDATE usuarios SET estado = 'activo' WHERE  usuario = '$user' AND clave = '$pass'") ;
    
                if($reactivacion){
                    echo "Tu usuario se encuentra nuevamente activo";
                }
            }
        
        echo "<a href='login.php'>Log In</a>";

    ?>
</body>
</html>