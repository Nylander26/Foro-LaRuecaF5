<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temas</title>
    <link rel="stylesheet" href="./styles/temas.css">
</head>
<body>
    
    <br>
        <form action="hilo.php?id=<?php echo $_SESSION['id']; ?>" method="POST">
        <input type="hidden" name="newHilo" value="<?php echo $row["id"]; ?>">  
        <input type="submit" value='Nuevo Hilo' class="button">
        </form>                
    
    <?php
    
    require("config/config.php");
    $idTema= $_POST['idTema'];
    $hilos = $conexion->query("SELECT * FROM hilos WHERE idTemas = '$idTema' ");//consulta los Hilos asociados al Tema que se está viendo desde POST
    
        if ($idTema === $row["id"])
        {
    
            while ($row = $hilos->fetch_assoc())
            { 
                $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['idUsuario']."'");
                $usuarioImg = $conexion->query("SELECT imagen FROM usuarios WHERE id = '".$row["idUsuario"]."'");
                $rowImg = $usuarioImg->fetch_assoc();
                $rowUser = $usuarioName->fetch_assoc();
                    ?>
    
                <!--Imprime tantos hilos existan en el Tema -->
            <div class="divHilo" >
    
                <h3> <?php echo $row["hilos"]; ?> </h3>
                <h4> <?php echo $row["contHilo"]; ?> </h4>
                <h5> Publicado por: <?php echo $rowUser["usuario"]; ?> </h5>

                <?php if(isset($usuarioImg)){ ?>
                    <img src="<?php echo $rowImg["imagen"];?>">
                <?php } ?>

                <form action="comentarios.php?id=<?php echo $_SESSION['id']; ?>" method="POST">
                    <input type="hidden" name="newComent" value="<?php echo $row["id"]; ?>">  
                    <input type="submit" value="Comentar Hilo" class="button">
                </form>
                
                <?php 
                    $idHilo= $row["id"];
                    $comentarios = $conexion->query("SELECT * FROM comentarios WHERE idHilo = '$idHilo'");
                    while ($rowC = $comentarios->fetch_assoc()) {?>
                        <div>
                            <?php echo $rowC["comentario"];?>
                        </div>
                        <div>
                            <aside>Publicado por: <?php echo $rowUser["usuario"];?></aside>
                        </div>
                    <?php } //Cierre while comentario ?>
                    </div>
                    <br>
                <?php }//Cierre while Hilos ?>
                </div>
                </div>
        <?php } //Cierre IF ?>
        
</body>
</html>
