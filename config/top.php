
<div class="top">
    <div class="divTop">
        <div><img src="img/logo2.png" class="logoTop"> </div>
        <div><?php echo "Bienvenido ". $_SESSION["usuario"].""; ?></div>
    </div>

    <div class="divTop" >
    <a href="foryou.php">Home</a>
    </div>

    <div class="divTop" >
    <a href="perfil.php?id=<?php echo $_SESSION['id']; ?>">Mi Perfil</a>
    </div>

    <div class="divTop" >Buscar
    </div>

    <div class="divTop">
    <a href='logout.php'>Salir</a>
    </div>
</div>

<?php



?>