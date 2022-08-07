<!--Protocolo para la interconexion entre el servidor y la BD-->

<?php

$CONserver = "localhost";
$CONuser = "root";
$CONpass = "";
$CONbd = "foro";

$conexion = new mysqli($CONserver, $CONuser, $CONpass, $CONbd);

if($conexion->connect_errno){
    die("La conexion ha fallado.");
}

?>