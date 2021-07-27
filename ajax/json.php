<?php 
	include_once("../class/class_conexion.php");
	include_once("../class/class_categoria.php");
	include_once("../class/class_usuario.php");
	session_start();
	$conexion = new Conexion();
	switch ($_GET["accion"]) {
		case '1'://obtener informacion modal actualizar categoria
				$sql = sprintf("SELECT id_categoria, nombre_cat, descripcion 
							FROM categoria_pregunta 
				 	 WHERE id_categoria = '%s'",
					stripslashes($_POST["idCategoria"]));

				 $resultado=$conexion->ejecutarInstruccion($sql);
				 $fila = $conexion->obtenerFila($resultado);
				 $fila = array_map('utf8_encode', $fila);
				 echo json_encode($fila);
		break;

		case '2'://obtener informacion modal actualizar Pregunta
				$sql = sprintf("SELECT id_pregunta, pregunta, tipo_respuesta_idTipoR, categorias_id_categoria 
							FROM pregunta 
				 	 WHERE id_pregunta = '%s'",
					stripslashes($_POST["idPregunta"]));

				 $resultado=$conexion->ejecutarInstruccion($sql);
				 $fila = $conexion->obtenerFila($resultado);
				 $fila = array_map('utf8_encode', $fila);
				 echo json_encode($fila);
		break;

		case '3'://comprobacion del login Usuario
				$usuario = $_POST['usuario'];
				$contrasena = $_POST['contrasena'];
				$resultado = usuario::inicioSesion($conexion, $usuario, $contrasena);
				$_SESSION["nombre_usuario"] = $resultado["nombre_usuario"];
				$_SESSION["inicio"] = $resultado["inicio"];
				$_SESSION["posicion"] = $resultado["posicion"];
				$_SESSION["id"]= $resultado["id"];
				$_SESSION["numero_empleado"]= $resultado["numero_empleado"];
				echo json_encode($resultado);
				
		break;

		case '4'://obtener informacion modal actualizar Usuario
				$sql = sprintf("SELECT a.id, a.personal_id_personal, a.username ,a.email, b.nombres ,b.apellidos, b.id_personal, b.no_empleado FROM user1 a INNER JOIN personal1 b ON a.personal_id_personal = b.id_personal where a.id='%s'", 
					stripslashes($_POST["idUsuario"]));

				 $resultado=$conexion->ejecutarInstruccion($sql);
				 $fila = $conexion->obtenerFila($resultado);
				 $fila = array_map('utf8_encode', $fila);
				 echo json_encode($fila);
		break;	

		case '5'://Revision De exixtencia de usuario
			$sql = sprintf("SELECT id, username
                                FROM user1 
                             WHERE username = '%s'",
                            stripslashes($_POST["txtUserH"]));

            $resultado=$conexion->ejecutarInstruccion($sql);
            $fila = $conexion->obtenerFila($resultado);
			$fila = array_map('utf8_encode', $fila);
			echo json_encode($fila);

		break;

		default:		
			# code...
			break;
	}
?>
