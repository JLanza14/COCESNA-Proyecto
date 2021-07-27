<?php
    include_once("class/class_conexion.php");
    include_once("class/class_usuario.php"); 
    $conexion = new Conexion();
    session_start();
    if(!isset($_SESSION['nombre_usuario'])||($_SESSION['inicio']==2))
    header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Edicion y Creacion de Usuario</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
       .color-letras{
          color: #ffffff;
         font-size: 15px;
       }
 
       .error-form{
         background-color: #e26161; 
         display: none;
       }
  </style>
</head>

<body>

  <!-- Start your project here-->
  <!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark blue-gradient lighten-1">
  <a class="navbar-brand" href="#"><img src="img/Cocesna-Logo.png" height="50" alt="mdb logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse " id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index_admin.php">Inicio
          <span class="sr-only">(current)</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['nombre_usuario']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
          <a class="dropdown-item" href="cerrar_sesion.php">Log out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar --> 
    <!-- Editable table -->
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Administracion de Usuario</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a data-toggle="modal" data-target="#modal-agregar-usuario" href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i> Agregar Nuevo Usuario</a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Email</th>
            <th class="text-center">Fecha de Creacion</th>
            <th class="text-center">Edicion</th>
          </tr>
        </thead>
        <tbody>
        <?php
                    
                    usuario::GenerarTablaUsuarios($conexion);
              ?>
        </tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->
<!-- Ventana Modal Agregar Nuevo Usuario-->
<div class="modal fade" id="modal-agregar-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div class="md-form" name="NombreUsuario">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtNombreUsuario" id="txtNombreUsuario" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtNombreUsuario">Nombre de Usuario</label>
              <div id="mensaje1" name="mensaje1" class="well error-form text-center"> Error, campo vacio, ingrese el nombre Usuario.</div>
            </div>

            <div class="md-form" name="Contrasenia">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtContrasenia" id="txtContrasenia" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtContrasenia">Contraseña</label>
              <div id="mensaje2" name="mensaje2" class="well error-form text-center"> Error, campo vacio o incorrecto, ingrese Contrasena al menos 1 mayuscula, 1 numero y al menos 8 caracteres.</div>
            </div>

            <div class="md-form" name="Correo">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtCorreo" id="txtCorreo" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtCorreo">Correo Electronico</label>
              <div id="mensaje3" name="mensaje3" class="well error-form text-center"> Error, campo vacio o incorrecto, ingrese el Correo.</div>
            </div>

            <div class="md-form" name="NombrePersonal">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtNombrePersonal" id="txtNombrePersonal" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtNombrePersonal">Nombres</label>
              <div id="mensaje4" name="mensaje4" class="well error-form text-center"> Error, campo vacio, ingrese el nombre .</div>
            </div>

            <div class="md-form" name="ApellidosPersonal">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtApellidosPersonal" id="txtApellidosPersonal" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtApellidosPersonal">Apellidos</label>
              <div id="mensaje5" name="mensaje5" class="well error-form text-center"> Error, campo vacio, ingrese el apellido.</div>
            </div>

            <div name="Sexo" align="center">
              <label for='txtSexo'>Seleccione el Genero</label>
              <select name='txtSexo' id='txtSexo' class='form-control btn btn-primary' style='height: 40px; width: 350px;'>
                <option value='M'>Masculino</option>
                <option value='F'>Femenino</option>
              </select>
            </div>

            <div class="md-form" name="NumEEmpleado">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtNumEmpleado" id="txtNumEmpleado" class="md-textarea form-control" rows="1"></textarea>
              <label for="txtNumEmpleado">Numero Empleado</label>
              <div id="mensaje7" name="mensaje7" class="well error-form text-center"> Error, campo vacio, ingrese Numero de empleado.</div>
            </div>
            <br>            

            <div class="md-form" name="FechaNacimiento">
              <i class="fas fa-pencil-alt prefix"></i>
              <input type="date" name="dte-fecha-nacimiento" id="dte-fecha-nacimiento" step="1" min="01-01-1900" max="31-31-2099"
                          value="<?php echo date('Y-m-d');?>"
                          class="date">
              <label for="dte-fecha-nacimiento">Fecha Nacimiento</label>
            </div>
            <br>

            <div class="md-form" name="FechaIngreso">
              <i class="fas fa-pencil-alt prefix"></i>
              <input type="date" name="dte-fecha-ingreso" id="dte-fecha-ingreso" step="1" min="01-01-1900" max="31-31-2099"
                          value="<?php echo date('Y-m-d');?>"
                          class="date">
              <label for="dte-fecha-ingreso">Fecha Ingreso al sistema</label>
            </div>
            <div align="center">
              <label for='tipo-usuario'>Seleccione el Tipo de Usuario</label>
                 <?php
                    usuario::GenerarTipoDeUsuario($conexion);
                  ?>
            </div>
            
  

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-GuardarUsuario" name="btn-GuardarUsuario"  class="btn btn-primary">Guardar Nuevo Usuario</button>
          </div>
    </div>
  </div>
</div>

<!-- Ventana Modal Editar Usuario-->
<div class="modal fade" id="modal-editar-usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizacion Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <div class="md-form" name="editarNombreUsuario">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txteditarNombreUsuario" id="txteditarNombreUsuario" class="md-textarea form-control" rows="1"></textarea>
              <label for="txteditarNombreUsuario">Nombre de Usuario</label>
              <div id="mensaje8" name="mensaje8" class="well error-form text-center"> Error, campo vacio, ingrese el nombre Usuario.</div>
            </div>

            <div class="md-form" name="editarCorreo">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txteditarCorreo" id="txteditarCorreo" class="md-textarea form-control" rows="1"></textarea>
              <label for="txteditarCorreo">Correo Electronico</label>
              <div id="mensaje9" name="mensaje9" class="well error-form text-center"> Error, campo vacio o incorrecto, ingrese el Correo.</div>
            </div>

            <div class="md-form" name="editarNumeroEmpleado">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txteditarNumeroEmpleado" id="txteditarNumeroEmpleado" class="md-textarea form-control" rows="1"></textarea>
              <label for="txteditarNumeroEmpleado">Numero De Empleado</label>
              <div id="mensaje10" name="mensaje10" class="well error-form text-center"> Error, campo vacio, ingrese Numero de empleado.</div>
            </div>
            
            <div class="md-form" name="editarNombrePersonal">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txteditarNombrePersonal" id="txteditarNombrePersonal" class="md-textarea form-control" rows="1"></textarea>
              <label for="txteditarNombrePersonal">Nombres</label>
              <div id="mensaje11" name="mensaje11" class="well error-form text-center"> Error, campo vacio, ingrese el nombre .</div>
            </div>

            <div class="md-form" name="editarApellidosPersonal">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txteditarApellidosPersonal" id="txteditarApellidosPersonal" class="md-textarea form-control" rows="1"></textarea>
              <label for="txteditarApellidosPersonal">Apellidos</label>
              <div id="mensaje12" name="mensaje12" class="well error-form text-center"> Error, campo vacio, ingrese el apellido.</div>
            </div>

            <div name="Sexo" align="center">
              <label for='txteditarSexo'>Seleccione el Genero</label>
              <select name='txteditarSexo' id='txteditarSexo' class='form-control btn btn-primary' style='height: 40px; width: 350px;'>
                <option value='M'>Masculino</option>
                <option value='F'>Femenino</option>
              </select>
            </div>

            <div class="md-form" name="FechaNacimiento">
              <i class="fas fa-pencil-alt prefix"></i>
              <input type="date" name="dte-editarfecha-nacimiento" id="dte-editarfecha-nacimiento" step="1" min="01-01-1900" max="31-31-2099"
                          value="<?php echo date('Y-m-d');?>"
                          class="date">
              <label for="dte-fecha-nacimiento">Fecha Nacimiento</label>
            </div>
            <br>

            <div class="md-form" name="FechaActualizacion">
              <i class="fas fa-pencil-alt prefix"></i>
              <input type="date" name="dte-editarfecha-act" id="dte-editarfecha-act" step="1" min="01-01-1900" max="31-31-2099"
                          value="<?php echo date('Y-m-d');?>"
                          class="date">
              <label for="dte-fecha-ingreso">Fecha actualizacion</label>
            </div>


            <div align="center">
              <label for='tipo-usuario'>Seleccione el Tipo de Usuario</label>
                 <?php
                    usuario::GenerarTipoDeUsuarioUp($conexion);
                  ?>
            </div>

        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-EditarUsuario" name="btn-EditarUsuario"  class="btn btn-primary">Actualizar Usuario</button>
          </div>
    </div>
  </div>
</div>




  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/controlador_usuarios.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
