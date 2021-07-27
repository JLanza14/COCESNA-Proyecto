<?php
include_once("class/class_conexion.php");

	session_start();
	if(!isset($_SESSION['nombre_usuario'])||($_SESSION['inicio']==2))
    header("Location: index.php");
	$conexion = new Conexion();
		$result = $conexion->ejecutarInstruccion("SELECT u.email from user1 u inner JOIN personal1 p on p.id_personal=u.personal_id_personal
		where posicion_id_posicion=3 and u.id in (select user_id from enviar_notificacion);");
		
		$header  = 'From: cconcesnanotificacion@gmail.com' . "\r\n" ;
		$email_subject="Notificacion Sistema de evaluacion de salud Cocesna";
		$email_message="se le notifica que el usuario: ".$_GET['nombreUser']." ha decidido responder a la encuesta de Evaluacion de salud del empleado y se hace un llamado a que se hagan las acciones correspondientes al caso.";

		while ($row = $conexion->obtenerFila($result)){
			mail($row['email'], $email_subject , $email_message ,$header);
			echo $row['email'];
		}

	session_destroy();
    header("Location: index.php");
?>
