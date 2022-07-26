<!--Protocolo para cierre de sesion simple-->

<?php

session_start();

session_destroy();

header("Location: login.php");

?>