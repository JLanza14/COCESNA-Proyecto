<?php

	class categoria{

		private $ID;
		private $nombreCategoria;
		private $descripcionCategoria;
		private $mensaje;
		private $error;

		public function __construct($ID,
					$nombreCategoria,
					$descripcionCategoria,
					$mensaje,
					$error){
			$this->ID = $ID;
			$this->nombreCategoria = $nombreCategoria;
			$this->descripcionCategoria = $descripcionCategoria;
			$this->mensaje = $mensaje;
			$this->error = $error;
		}
		public function getID(){
			return $this->ID;
		}
		public function setID($ID){
			$this->ID = $ID;
		}
		public function getNombreCategoria(){
			return $this->nombreCategoria;
		}
		public function setNombreCategoria($nombreCategoria){
			$this->nombreCategoria = $nombreCategoria;
		}
		public function getDescripcionCategoria(){
			return $this->descripcionCategoria;
		}
		public function setDescripcionCategoria($descripcionCategoria){
			$this->descripcionCategoria = $descripcionCategoria;
		}
		public function getMensaje(){
			return $this->mensaje;
		}
		public function setMensaje($mensaje){
			$this->mensaje = $mensaje;
		}
		public function getError(){
			return $this->error;
		}
		public function setError($error){
			$this->error = $error;
		}
		public function toString(){
			return "ID: " . $this->ID . 
				" NombreCategoria: " . $this->nombreCategoria . 
				" DescripcionCategoria: " . $this->descripcionCategoria . 
				" Mensaje: " . $this->mensaje . 
				" Error: " . $this->error;
		}

		//Genera las categorias en la opcion categorias de administrador
		public static function GenerarTablaCategoria($conexion){
				$categorias = $conexion->ejecutarInstruccion('SELECT id_categoria, nombre_cat, descripcion 
							FROM categoria_pregunta 
							');

						while ($fila_categoria = $conexion->obtenerFila($categorias)) {
					?>
						<tr>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_categoria['nombre_cat'];?></td>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_categoria['descripcion'];?></td>
				            <td>
				              <span class="table-remove">
				              	<a type="button" onclick="eliminarCategoria('<?php echo $fila_categoria["id_categoria"]; ?>')" 
				              		name='btn_eliminarCat' id='btn_eliminarCat' class="btn btn-danger btn-rounded btn-sm my-0">Eliminar Categoria</a></span>
				              <span class="table-remove">
				              	<a type="button" class="btn btn-info btn-rounded btn-sm my-0" href="edicion_preguntas.php?id_cate=<?php echo $fila_categoria["id_categoria"]; ?>">Editar Preguntas</a></span>
				              <span class="table-remove">
				              	<a type="button" data-toggle="modal" data-target="#modal-editar-categoria" class="btn btn-info btn-rounded btn-sm my-0" onclick="actualizarCategoria('<?php echo $fila_categoria["id_categoria"]; ?>')" name="modCate" 
				              	id="modCate" >Cambiar Nombre y Descripcion</a></span>
				            </td>
				        </tr>
					<?php
						}
						$conexion->liberarResultado($categorias);
		}

		//Genera las preguntas para la opcion categorias en la pagina administrador
		public static function GenerarPreguntasxCategoria($conexion, $codigoCate){
				$preguntascate = $conexion->ejecutarInstruccion("SELECT id_pregunta, pregunta, tipo_respuesta_idTipoR, 								categorias_id_categoria 
								FROM pregunta
								WHERE categorias_id_categoria = '$codigoCate'");

						while ($fila_preguntascate = $conexion->obtenerFila($preguntascate)) {
					?>
						<tr>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_preguntascate['pregunta'];?></td>
				            <td>
				              <span class="table-remove"><button type="button" onclick="eliminarPregunta('<?php echo $fila_preguntascate["id_pregunta"]; ?>')"
				                  class="btn btn-danger btn-rounded btn-sm my-0">Eliminar Pregunta</button></span>
				              <span class="table-remove"><button data-toggle="modal" data-target="#modal-Editar-Pregunta"
				              	type="button" onclick="actualizarPregunta('<?php echo $fila_preguntascate["id_pregunta"]; ?>')" class="btn btn-info btn-rounded btn-sm my-0">Editar Pregunta</button></span>
				            </td>
				        </tr>
					<?php
						}
						$conexion->liberarResultado($preguntascate);
		}

		//Generador del select Tipo respuesta
		public static function GenerarTipoRespuesta($conexion){
				$tipoRespuesta = $conexion->ejecutarInstruccion('SELECT idTipoR, respuesta, detalle_respuesta 
							FROM tipo_respuesta 
							');

				echo "<select name='tipo-respuesta' id='tipo-respuesta' class='form-control btn btn-primary' style='height: 40px; width: 300px;'>";
						while ($fila_TipoR = $conexion->obtenerFila($tipoRespuesta)) {
							echo "<option value='".$fila_TipoR["idTipoR"]."'>
							".$fila_TipoR["respuesta"]."</option>";
						}
						echo "</select>";
						$conexion->liberarResultado($tipoRespuesta);
		}

		public static function GenerarTipoRespuestaActualizar($conexion){
				$tipoRespuesta = $conexion->ejecutarInstruccion('SELECT idTipoR, respuesta, detalle_respuesta 
							FROM tipo_respuesta 
							');

				echo "<select name='tipo-respuestaA' id='tipo-respuestaA' class='form-control btn btn-primary' style='height: 40px; width: 300px;'>";
						while ($fila_TipoR = $conexion->obtenerFila($tipoRespuesta)) {
							echo "<option value='".$fila_TipoR["idTipoR"]."'>
							".$fila_TipoR["respuesta"]."</option>";
						}
						echo "</select>";
						$conexion->liberarResultado($tipoRespuesta);
		}


		//Generador del select Tipo respuesta para modal Actualizar
		public static function GenerarCategoriasSelect($conexion){
				$selectCategorias = $conexion->ejecutarInstruccion('SELECT id_categoria, nombre_cat, descripcion 
							FROM categoria_pregunta 
							');

				echo "<select name='select-categoria' id='select-categoria' class='form-control btn btn-primary' style='height: 40px; width: 300px;'>";
						while ($fila_TipoR = $conexion->obtenerFila($selectCategorias)) {
							echo "<option value='".$fila_TipoR["id_categoria"]."'>
							".$fila_TipoR["nombre_cat"]."</option>";
						}
						echo "</select>";
						$conexion->liberarResultado($selectCategorias);
		}

		//Generador de pregunta filtro para la encuesta
		public static function GenerarPreguntaFiltro($conexion){
				$Filtro = $conexion->ejecutarInstruccion('SELECT idFiltro, pregunta_filtro, tipo_respuesta_idTipoR 
							FROM pregunta_filtro 
							');
				$Superv = 'Encuesta respondida por un controlador';
						while ($fila_categoria = $conexion->obtenerFila($Filtro)) {
					?>
						<h5 class="card-title white-text"><?php echo $fila_categoria['pregunta_filtro'];?></h5>
		                <p class="card-text white-text" >Seleccione su Respuesta</p>
		                <a href="agradecimiento.php" class="btn btn-primary">SI</a>
		                <a href="encuesta.php" class="btn btn-danger" onclick="EjecutarPEncuesta('<?php echo $Superv;?>')">NO</a>
					<?php
						}
						$conexion->liberarResultado($Filtro);
		}

		//Generador de pregunta filtro para la encuesta supervisor
		public static function GenerarPreguntaFiltroSupervisor($conexion){
				$Filtro = $conexion->ejecutarInstruccion('SELECT idFiltro, pregunta_filtro, tipo_respuesta_idTipoR 
							FROM pregunta_filtro 
							');

						while ($fila_categoria = $conexion->obtenerFila($Filtro)) {
					?>
						<h5 class="card-title white-text"><?php echo $fila_categoria['pregunta_filtro'];?></h5>
		                <p class="card-text white-text" >Seleccione su Respuesta</p>
					<?php
						}
						$conexion->liberarResultado($Filtro);
		}
		
		//genera la ventana de edicion de pregunta filtro
		public static function GenerarPreguntaFiltroAdministrador($conexion){
				$Filtro = $conexion->ejecutarInstruccion('SELECT idFiltro, pregunta_filtro, tipo_respuesta_idTipoR 
							FROM pregunta_filtro 
							');

						while ($fila_categoria = $conexion->obtenerFila($Filtro)) {
					?>
						<thead>
				          <tr>
				            <th class="text-center" contenteditable="false">
				            <input type="text" name="txt-actualizarFiltro" id="txt-actualizarFiltro" value="<?php echo $fila_categoria['pregunta_filtro'];?>"class="md-textarea form-control text-center" rows="1">
				            	
				            </input>
				            </th>
				          </tr>
				        </thead>
				        <tbody>
				          <tr>
				            <td colspan="2">
				              <span class="table-remove float-center">
				              	<button type="button" name="btn-actualizarFiltro" id="btn-actualizarFiltro" class="btn btn-success btn-rounded waves-effect btn-lg btn-block">
				              		Guardar Cambios
				              	</button>
				              </span>
				            </td>      
				          </tr>
				        </tbody>
					<?php
						}
						$conexion->liberarResultado($Filtro);
		}

		//genera las tarjetas de categoria de la pagina de encuesta
		public static function GenerarCategoriasEncuesta($conexion){
				$categorias = $conexion->ejecutarInstruccion('SELECT id_categoria, nombre_cat, descripcion 
							FROM categoria_pregunta 
							');

						while ($fila_categoria = $conexion->obtenerFila($categorias)) {
					?>
						<div class="col-lg-3 col-md-6 mb-4"
							 style="width: auto;
							         height: auto;
							         margin-right: 2%;">

						<div class="card card-image view view-cascade gradient-card-header peach-gradient">

						  <!-- Content -->
						  <div class="text-white text-center d-flex align-items-center rgba-black-strong py-5 px-4">
						    <div>
						      <h5 class="orange-text"><i class="fas fa-laptop-medical"></i></h5>
						      <h3 class="card-title pt-2"><strong><?php echo $fila_categoria['nombre_cat'];?></strong></h3>
						      <p><?php echo $fila_categoria['descripcion'];?></p>
						      <button onclick="mostrarPreguntasCategoria('<?php echo $fila_categoria["id_categoria"]; ?>')" 
						      	data-toggle="modal" data-target="#modal-preguntas-categoria" class="btn btn-orange"><i class="fas fa-clone left"></i>Ver Preguntas de <?php echo $fila_categoria['nombre_cat'];?></button>
						    </div>
						  </div>

						</div>

						</div>
					<?php
						}
						$conexion->liberarResultado($categorias);
		}

		//Genera las preguntas para la modal en pagina encuesta
		public static function GenerarPreguntasEncuesta($conexion, $codigoCate){
				$preguntascate = $conexion->ejecutarInstruccion("SELECT id_pregunta, pregunta, tipo_respuesta_idTipoR, 								categorias_id_categoria 
								FROM pregunta
								WHERE categorias_id_categoria = '$codigoCate'");
					?>
					<table class="table table-bordered table-responsive-md table-striped text-center">
		              <thead>
		                <tr>
		                  <th class="text-center">Preguntas</th>
		                  <th class="text-center">Cambios</th>
		                </tr>
		              </thead>
		              <tbody>
		            
		           
              
					<?php
    	                $k=0;
						$i=0;
						$j=0;
						$cj=0;
						$ej=0;
						while ($fila_preguntascate = $conexion->obtenerFila($preguntascate)) {
					?>
						<tr>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_preguntascate['pregunta'];?></td>
				            <td>
				            	<?php 
				            	if ($fila_preguntascate['tipo_respuesta_idTipoR']==1){
	            				?>	
	            					<input type="text" name="<?php echo "txtcodigoPregunta".$i;  ?>" id="<?php echo "txtcodigoPregunta".$i;  ?>" value="<?php echo $fila_preguntascate['id_pregunta'];?>" style="display: none">

	            					<input type="text" name="<?php echo "txtcodigoTipoPregunta".$i;  ?>" id="<?php echo "txtcodigoTipoPregunta".$i;  ?>" value="<?php echo $fila_preguntascate['tipo_respuesta_idTipoR'];?>" style="display: none">

	            					<div class="form-check form-check-inline">				                                  
	                                   <h4><label class="form-check-label badge badge-pill badge-danger" for="<?php echo "A".$i;  ?>">
	                                   <input type="radio" class="form-check-input" id="<?php echo "A".$i;  ?>" 
	                                   name="<?php echo "radioCerrada".$i;?>" value="si" checked style="transform: scale(1.5);">
	                                   SI</label></h4>
	                                </div>

	                                <div class="form-check form-check-inline">
	                                   <h4><label class="form-check-label badge badge-pill badge-primary" for="<?php echo "B".$i;  ?>">
	                                  <input type="radio" class="form-check-input" id="<?php echo "B".$i; ?>" 
	                                  name="<?php echo "radioCerrada".$i;?>" value="no" style="transform: scale(1.5);">
	                                  NO</label></h4>
	                                </div>;
				                <?php
				                $i++;
				                $k++;
				                $cj++;
				            	} 
				            		
			            		elseif($fila_preguntascate['tipo_respuesta_idTipoR']==2){
			            		?>	
			            			<input type="text" name="<?php echo "txtcodigoPreguntaB".$j;  ?>" id="<?php echo "txtcodigoPreguntaB".$j;  ?>" value="<?php echo $fila_preguntascate['id_pregunta'];?>" style="display: none">

			            			<input type="text" name="<?php echo "txtcodigoTipoPreguntaB".$j;  ?>" id="<?php echo "txtcodigoTipoPreguntaB".$j;  ?>" value="<?php echo $fila_preguntascate['tipo_respuesta_idTipoR'];?>" style="display: none">

	            					<div class="form-check form-check-inline">
	                                   <h4><label class="form-check-label badge badge-pill badge-danger" for="<?php echo "AA".$j;  ?>">
	                                   <input type="radio" class="form-check-input" id="<?php echo "AA".$j;  ?>" 
	                                   name="<?php echo "radioEscalable".$j;?>" value="mal" checked style="transform: scale(1.5); ">
	                                   mal</label></h4>
	                                </div>

	                                <div class="form-check form-check-inline">
	                                   <h4><label class="form-check-label badge badge-pill badge-primary" for="<?php echo "BB".$j;  ?>">
	                                  <input type="radio" class="form-check-input" id="<?php echo "BB".$j;  ?>" 
	                                  name="<?php echo "radioEscalable".$j;?>" value="bien" style="transform: scale(1.5);">
	                                  Bien</label></h4>
	                                </div>

	                                <div class="form-check form-check-inline">
	                                  <h4><label class="form-check-label badge badge-pill badge-success" for="<?php echo "CC".$j;  ?>">
	                                  <input type="radio" class="form-check-input" id="<?php echo "CC".$j;  ?>" 
	                                  name="<?php echo "radioEscalable".$j;?>" value="muy bien" style="transform: scale(1.5);">
	                                  Muy Bien</label></h4>
	                                </div>

	                                <div class="form-check form-check-inline">
	                                  <h4><label class="form-check-label badge badge-pill badge-secondary" for="<?php echo "DD".$j;  ?>">
	                                  <input type="radio" class="form-check-input" id="<?php echo "DD".$j;  ?>" 
	                                  name="<?php echo "radioEscalable".$j;?>" value="exelente" style="transform: scale(1.5);">
	                                  Exelente</label></h4>
	                                </div>
			                                
			            		<?php
			            		$j++;
			            		$k++;
			            		$ej++;}
				            	?>
				            </td>
				        </tr>
					<?php
						}
					?>
					   <input type="text" name="txtcantidadPreguntas" id="txtcantidadPreguntas" value="<?php echo $k;?>" style="display: none">
					   <input type="text" name="txtcantidadPreguntasCer" id="txtcantidadPreguntasCer" value="<?php echo $cj;?>" style="display: none">
					   <input type="text" name="txtcantidadPreguntasEsc" id="txtcantidadPreguntasEsc" value="<?php echo $ej;?>" style="display: none">
					   <input type="text" name="txtcurrentCat" id="txtcurrentCat" value="<?php echo $codigoCate;?>" style="display: none">

				      </tbody>
           		    </table>
           		    <?php
						$conexion->liberarResultado($preguntascate);
		}


}
?>