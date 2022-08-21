<div style = "width: 100%; float: left; margin-bottom: 30px;">
    <div class="divTop"><img src="img/logo2.png" class="logo"><?php echo "Bienvenido ". $_SESSION["usuario"]."<br><br>"; ?></div>
    <div style= "float: left; width: 20%;"><a href="foryou.php">Home</a></div>
    <div style= "float: left; width: 20%;"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Mi Perfil</a></div>
    <div style= "float: left; width: 20%;">Buscar</div>
    <div style= "float: left; width: 20%;"><a href='logout.php'>Salir</a></div>
</div>

<?php

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