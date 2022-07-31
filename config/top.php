<?php

     require("config/config.php");
     $solicitar = $conexion->query("SELECT * FROM usuarios WHERE id = '".$_GET['id']."'");
     $row = $solicitar->fetch_assoc();

?>
<div style = "width: 100%; float: left; margin-bottom: 30px;">
    <div style= "float: left; width: 20%;"><?php echo "Bienvenido ". $row['usuario']."<br><br>"; ?></div>
    <div style= "float: left; width: 20%;"><a href="index.php?id=<?php echo $_SESSION['id']; ?>">Home</a></div>
    <div style= "float: left; width: 20%;"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Mi Perfil</a></div>
    <div style= "float: left; width: 20%;">Buscar</div>
    <div style= "float: left; width: 20%;"><a href='logout.php'>Salir</a></div>
</div>