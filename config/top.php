<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/top.css">
</head>
<body>
    
    <?php

    require("config/config.php");
    $solicitar = $conexion->query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
    $row = $solicitar->fetch_assoc();

    require("config/config.php");
    $solicitar = $conexion->query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
    $row = $solicitar->fetch_assoc();

    ?>
    <?php if ($_GET["id"] == $_SESSION["id"]){ ?>
        <div class="container-top">
            <div class="body-top"><?php echo "Bienvenido ". $row['usuario']."<br><br>"; ?></div>
            <div class="body-top"><a href="index.php?id=<?php echo $_SESSION['id']; ?>">Home</a></div>
            <div class="body-top"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Mi Perfil</a></div>
            <div class="body-top"><a href='logout.php'>Salir</a></div>
        </div>
    <?php }?>
    
</body>
</html>