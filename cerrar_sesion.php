<?php
	session_start();
	if(!isset($_SESSION['nombre_usuario'])||($_SESSION['inicio']==2))
    header("Location: index.php");
	session_destroy();
    header("Location: index.php");
?>