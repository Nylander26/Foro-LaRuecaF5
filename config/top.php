<div style = "width: 100%; float: left; margin-bottom: 30px;">
    <div style= "float: left; width: 20%;"><?php echo "Bienvenido ". $_SESSION["usuario"]."<br><br>"; ?></div>
    <div style= "float: left; width: 20%;"><a href="foryou.php">Home</a></div>
    <div style= "float: left; width: 20%;"><a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Mi Perfil</a></div>
    <div style= "float: left; width: 20%;">Buscar</div>
    <div style= "float: left; width: 20%;"><a href='logout.php'>Salir</a></div>
</div>

<?php



?>