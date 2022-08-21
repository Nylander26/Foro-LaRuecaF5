<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    
    require("config/config.php");
    $idTema= $_POST['idTema'];
    $hilos = $conexion->query("SELECT * FROM hilos WHERE idTemas = '$idTema' "); //consulta los Hilos asociados al Tema que se está viendo desde POST ?>
        
        <form action="hilo.php?id=<?php echo $_SESSION['id'];?>" method="POST">
            <input type="hidden" value="<?php $_SESSION["id"];?>">  
            <input type="submit" value='Nuevo Hilo'>
        </form>                
    
        <?php if ($idTema == $row["id"]) {
    
            while ($row = $hilos->fetch_assoc()){
    
                $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['idUsuario']."'");
                $rowUser = $usuarioName->fetch_assoc(); ?>
    
                <!--Imprime tantos hilos existan en el Tema -->
    
                <div class="divHilo" >
                    <h3> <?php echo $row["hilos"]; ?> </h3>
                    <h4> Publicado por: <?php echo $rowUser["usuario"]; ?> </h4>
                    <!--<img src="<?php echo $rowUser["imagen"];?>">-->
                    
                    <?php 
                        $idHilo= $_SESSION["id"];
                        $comentarios = $conexion->query("SELECT * FROM comentarios WHERE idHilo = '$idHilo'");

                        while ($rowC = $comentarios->fetch_assoc()) { 
                    ?>
                    <div class="divComentario">  
                        <?php echo $rowC["comentario"];?>
                    </div>
                </div>
                    <?php } //Cierre while comentario ?>
                <br>
            <?php }//Cierre while Hilos ?>
            <input type="submit" value="Agregar Comentario">
            </div>
        <?php } //Cierre IF ?>
</body>
</html>
   
           

