<!--Protocolo para la interconexion entre el servidor y la BD-->

<?php

/*$CONserver = "localhost";
$CONuser = "root";
$CONpass = "";
$CONbd = "foro";

$conexion = new mysqli($CONserver, $CONuser, $CONpass, $CONbd);

if($conexion->connect_errno){
    die("La conexion ha fallado.");
}*/

$CONserver = "ec2-63-32-248-14.eu-west-1.compute.amazonaws.com";
$CONuser = "gtuysgoaptpkqh";
$CONpass = "42615946fdf7e89c9dfb4c500ab06ad9550694902e425ebea0c6c1e7801caf28";
$CONbd = "dcr765vv4j3fl0";

$conexion = new mysqli($CONserver, $CONuser, $CONpass, $CONbd);

if($conexion->connect_errno){
    die("La conexion ha fallado.");
}

?>