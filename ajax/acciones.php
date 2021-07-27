<?php 
	include_once("../class/class_conexion.php");
	include_once("../class/class_categoria.php");
	session_start();
	$conexion = new Conexion();
	switch ($_GET["accion"]) {
		case '1'://registro de una nueva categoria
			$sql = "CALL SP_INCATEGORIA('".$_POST["txtNombreCat"]."', 
			'".$_POST["txtDescripcionCat"]."')";
			$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '2'://registro de pregunta en categoria
			$sql = "CALL SP_INPREGUNTA('".$_POST["txtPregunta"]."', 
			'".$_POST["tipo-respuesta"]."','".$_POST["Categoriaid"]."')";
			$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '3'://Eliminacion de una pregunta
				$idPregunta=$_POST['idPregunta'];
				$sql = "CALL SP_BORRARPREGUNTA('".$_POST["idPregunta"]."')";
				$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '4'://Eliminacion Categorias
				$idPregunta=$_POST['idPregunta'];
				$sql = "CALL SP_BORRARCATEGORIA('".$_POST["idCategoria"]."')";
				$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '5'://Actualizar Categoria
			$sql = "CALL SP_ACTUALIZARCATEGORIA('".$_POST["CodigoCategoriaActualizar"]."',
			'".$_POST["txt-editarNombreCat"]."', 
			'".$_POST["txt-editarDescripcionCat"]."')";
			$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '6'://Actualizar pregunta
			$sql = "CALL SP_ACTUALIZARPREGUNTA('".$_POST["CodigoPreguntaActualizar"]."','".$_POST["txt-editarPregunta"]."', 
			'".$_POST["tipo-respuestaA"]."','".$_POST["select-categoria"]."')";
			$res = $conexion->ejecutarInstruccion($sql);
			echo $sql;
		break;

		case '7'://Actualizar pregunta filtro
			$sql = "CALL SP_ACTUALIZARFILTRO( 1,'".$_POST["txt-actualizarFiltro"]."', 
			1)";
			$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '8'://Muestra Pregutas en modal de la pagina encuestas
			$idCategoria = $_POST["idCategoria"];
			categoria::GenerarPreguntasEncuesta($conexion, $idCategoria);
		break;

		case '9'://Eliminacion Usuario
				$id=$_POST['id'];
				$sql = "CALL SP_BORRARUSUARIO('".$_POST["id"]."')";
				$res = $conexion->ejecutarInstruccion($sql);
		break;

		case '10'://Agregar Usuario
		       $sql = "CALL SP_INPERSONAL('".$_POST["txtNombrePersonal"]."', 
			   '".$_POST["txtApellidosPersonal"]."',
			   '".$_POST["dte-fecha-nacimiento"]."',
			   '".$_POST["dte-fecha-ingreso"]."',
			   '".$_POST["txtSexo"]."',
			   '".$_POST["txtNumEmpleado"]."',
			   1)";
		     $res = $conexion->ejecutarInstruccion($sql);
		     $fechaint = strtotime($_POST["dte-fecha-ingreso"]);
		     $sqlid = ("SELECT id_personal
							FROM personal1
				 	 		ORDER BY id_personal DESC LIMIT 1");

		$resultado=$conexion->ejecutarInstruccion($sqlid);
	    $fila = $conexion->obtenerFila($resultado);
	    $hashpass = password_hash($_POST["txtContrasenia"], PASSWORD_DEFAULT);

			   $sql2 = "CALL SP_INUSR('".$_POST["tipo-usuario"]."', 
			   '".$fila["id_personal"]."',
			   '".$_POST["txtNombreUsuario"]."',
			   '".$_POST["txtContrasenia"]."',
			   '".$hashpass."',
			   null,
			   '".$_POST["txtCorreo"]."',
			   10,
			   '".$fechaint."',
			   '".$fechaint."',
			   null)";
		     $res2 = $conexion->ejecutarInstruccion($sql2);


		break; 

		case '11'://Actualizar Usuario
		 $codUp=$_POST["CodigoUsuarioActualizar"];
		 $sqlid = ("SELECT personal_id_personal, id
							FROM user1
				 	 		where id='$codUp'");

		$resultado=$conexion->ejecutarInstruccion($sqlid);
	    $fila = $conexion->obtenerFila($resultado);

			$sql= "CALL SP_ACTUALIZARPERSONAL('".$fila["personal_id_personal"]."', 
			'".$_POST["txteditarNombrePersonal"]."',
			'".$_POST["txteditarApellidosPersonal"]."',
			'".$_POST["dte-editarfecha-nacimiento"]."',
			'".$_POST["dte-editarfecha-act"]."',
			'".$_POST["txteditarSexo"]."',
			'".$_POST["txteditarNumeroEmpleado"]."',
			1)";

			$res = $conexion->ejecutarInstruccion($sql);

   		    $sql2 = "CALL SP_ACTUALIZARUSER('".$_POST["CodigoUsuarioActualizar"]."',
		    '".$_POST["tipo-usuarioEditar"]."',
		    '".$fila["personal_id_personal"]."',
		    '".$_POST["txteditarNombreUsuario"]."', 
		    '".$_POST["txteditarCorreo"]."', 
		    10)";

		    $res2 = $conexion->ejecutarInstruccion($sql2);

		break;

		case '12'://Activa una nueva encuesta
			$sql = "CALL SP_INENCUESTA('".$_POST["Superv"]."')";
			$res = $conexion->ejecutarInstruccion($sql);

		break;
		
		default:		
			# code...
			break;
	}
?>