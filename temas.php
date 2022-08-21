<br>
            <form action="hilo.php" method="POST">
            <input type="hidden" name="newHilo" value="<?php echo $row["id"]; ?>">  
            <input type="submit" value='Nuevo Hilo'>
            </form>                

<?php

require("config/config.php");
$idTema= $_POST['idTema'];
$hilos = $conexion->query("SELECT * FROM hilos WHERE idTemas = '$idTema' ");//consulta los Hilos asociados al Tema que se está viendo desde POST



if ($_POST['idTema'] == $row["id"])
{

    while ($row = $hilos->fetch_assoc())
    { 
        $usuarioName = $conexion->query("SELECT usuario FROM usuarios WHERE id = '".$row['idUsuario']."'");
        $rowUser = $usuarioName->fetch_assoc();
            ?>

        <!--Imprime tantos hilos existan en el Tema -->
    <div class="divHilo" >

        <h3> <?php echo $row["hilos"]; ?> </h3>
        <h4> Publicado por: <?php echo $rowUser["usuario"]; ?> </h4>
        <!--<img src="<?php echo $rowUser["imagen"];?>">-->
        
        <?php 
        $idHilo= $row["id"];
        $comentarios = $conexion->query("SELECT * FROM comentarios WHERE idHilo = '$idHilo'");
        while ($rowC = $comentarios->fetch_assoc())
        { 
        ?>
        <div class="divComentario">  <?php echo $rowC["comentario"];  ?>
        </div>

    </div>
    
        
        <?php } //Cierre while comentario ?>
        <br>

    <?php }//Cierre while Hilos ?>

    
    </div>
   

    <?php } //Cierre IF ?>
   
           

