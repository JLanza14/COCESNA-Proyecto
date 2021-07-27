<?php

	class usuario{

		private $ID;
		private $IDposicion;
		private $IDpersonal;
		private $username;
		private $auth_key;
		private $password_hash;
		private $password_reset_token;
		private $email;
		private $status;
		private $created_at;
		private $updated_at;
		private $verification_token;
		private $mensaje;
		private $error;

		public function __construct($ID,
					$IDposicion,
					$IDpersonal,
					$username,
					$auth_key,
					$password_hash,
					$password_reset_token,
					$email,
					$status,
					$created_at,
					$updated_at,
					$verification_token,
					$descripcionCategoria,
					$mensaje,
					$error){
			$this->ID = $ID;
			$this->IDposicion = $IDposicion;
			$this->IDpersonal = $IDpersonal;
			$this->username = $username;
			$this->auth_key = $auth_key;
			$this->password_hash = $password_hash;
			$this->password_reset_token = $password_reset_token;
			$this->email = $email;
			$this->status = $status;
			$this->created_at = $created_at;
			$this->updated_at = $updated_at;
			$this->verification_token = $nombreCategoria;
			$this->mensaje = $mensaje;
			$this->error = $error;
		}
		public function getID(){
			return $this->ID;
		}
		public function setID($ID){
			$this->ID = $ID;
		}
		public function getIDposicion(){
			return $this->IDposicion;
		}
		public function setIDposicion($IDposicion){
			$this->IDposicion = $IDposicion;
		}
		public function getIDpersonal(){
			return $this->IDpersonal;
		}
		public function setIDpersonal($IDpersonal){
			$this->IDpersonal = $IDpersonal;
		}
		public function getusername(){
			return $this->username;
		}
		public function setusername($username){
			$this->username = $username;
		}
		public function getauth_key(){
			return $this->auth_key;
		}
		public function setauth_key($auth_key){
			$this->auth_key = $auth_key;
		}
		public function getpassword_hash(){
			return $this->password_hash;
		}
		public function setpassword_hash($password_hash){
			$this->password_hash = $password_hash;
		}
		public function getpassword_reset_token(){
			return $this->password_reset_token;
		}
		public function setpassword_reset_token($password_reset_token){
			$this->password_reset_token = $password_reset_token;
		}
		public function getemail(){
			return $this->email;
		}
		public function setemail($email){
			$this->email = $email;
		}
		public function getstatus(){
			return $this->status;
		}
		public function setstatus($status){
			$this->status = $status;
		}
		public function getcreated_at(){
			return $this->created_at;
		}
		public function setcreated_at($created_at){
			$this->created_at = $created_at;
		}
		public function getupdated_at(){
			return $this->updated_at;
		}
		public function setupdated_at($updated_at){
			$this->updated_at = $updated_at;
		}
		public function getverification_token(){
			return $this->verification_token;
		}
		public function setverification_token($verification_token){
			$this->verification_token = $verification_token;
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
				" Username: " . $this->username . 
				" Auth_key: " . $this->email . 
				" Mensaje: " . $this->mensaje . 
				" Error: " . $this->error;
		}

		public static function GenerarTablaUsuarios($conexion){
				$usuarios = $conexion->ejecutarInstruccion('SELECT id, username, email, created_at
							FROM user1 
							');

						while ($fila_usuario = $conexion->obtenerFila($usuarios)) {
					?>
						<tr>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_usuario['id'];?></td>
				            <td class="pt-3-half" contenteditable="false"><?php echo $fila_usuario['username'];?></td>
							<td class="pt-3-half" contenteditable="false"><?php echo $fila_usuario['email'];?></td>
							<td class="pt-3-half" contenteditable="false"><?php echo $fila_usuario['created_at'];?></td>
				            <td>
				              <span class="table-remove">
				              	<a type="button" onclick="eliminarUsuario('<?php echo $fila_usuario["id"]; ?>')" 
				              		name='btn_eliminarUsuario' id='btn_eliminarUsuario' class="btn btn-danger btn-rounded btn-sm my-0">Eliminar Usuario</a></span>
				              <span class="table-remove">
				              	<a type="button" data-toggle="modal" data-target="#modal-editar-usuario" class="btn btn-info btn-rounded btn-sm my-0" onclick="actualizarUsuario('<?php echo $fila_usuario["id"]; ?>')" name="modUsr" 
				              	id="modUsr" >Editar</a>
							</span>
				              
				            </td>
				        </tr>
					<?php
						}
						$conexion->liberarResultado($usuarios);
		}


		public static function GenerarTipoDeUsuario($conexion){
			$TipoUsuario = $conexion->ejecutarInstruccion('SELECT id_posicion, posicion
						FROM posicion1
						');

					echo "<select name='tipo-usuario' id='tipo-usuario' class='form-control btn btn-primary' style='height: 40px; width: 300px;'>";
						while ($fila_idposicion = $conexion->obtenerFila($TipoUsuario)) {
							echo "<option value='".$fila_idposicion["id_posicion"]."'>
							".$fila_idposicion["posicion"]."</option>";
						}
						echo "</select>";
						$conexion->liberarResultado($TipoUsuario);
		}

		public static function GenerarTipoDeUsuarioUp($conexion){
			$TipoUsuario = $conexion->ejecutarInstruccion('SELECT id_posicion, posicion
						FROM posicion1
						');

					echo "<select name='tipo-usuarioEditar' id='tipo-usuarioEditar' class='form-control btn btn-primary' style='height: 40px; width: 300px;'>";
						while ($fila_idposicion = $conexion->obtenerFila($TipoUsuario)) {
							echo "<option value='".$fila_idposicion["id_posicion"]."'>
							".$fila_idposicion["posicion"]."</option>";
						}
						echo "</select>";
						$conexion->liberarResultado($TipoUsuario);
		}
		
		public static function inicioSesion($conexion, $usuario, $contrasena){
			$sql = ("SELECT 
						u.username, 
						u.password_hash,
						u.posicion_id_posicion,
						u.personal_id_personal,
						p.no_empleado
						FROM user1 u inner JOIN personal1 p
						WHERE username = '$usuario'");
			
			$respuesta = array();
			$sesion_usuario = $conexion->ejecutarInstruccion($sql);
			$fila = $conexion->obtenerFila($sesion_usuario);
			$meh = $fila["password_hash"];
			if($conexion->cantidadRegistros($sesion_usuario) >0){
				if (password_verify($contrasena, $meh))
				
				$respuesta["inicio"] = "1";
				$respuesta["nombre_usuario"] = $fila["username"];
				$respuesta["posicion"] = $fila["posicion_id_posicion"];
				$respuesta["id"] = $fila["personal_id_personal"];
				$respuesta["hashPass"] = $fila["password_hash"];
				$respuesta["numero_empleado"] = $fila["no_empleado"];
				
			
			}
			else {
				$respuesta["inicio"] = "0";
				$respuesta["resultado"] = "Usuario no Existe";
			}
			return $respuesta;
           $conexion->liberarResultado($resultado); 
		}



}
?>