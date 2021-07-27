<?php
    include_once("class/class_conexion.php");
    include_once("class/class_categoria.php"); 
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
  <title>Edicion Categorias</title>
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
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Edicion Categorias</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a data-toggle="modal" data-target="#modal-agregar-categoria" href="#!" class="text-success">
        <i class="fas fa-plus fa-2x" aria-hidden="true"></i> Agregar Categoria</a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Nombre Categoria</th>
            <th class="text-center">Descripcion de Categoria</th>
            <th class="text-center">Edicion de Categoria</th>
          </tr>
        </thead>
        <tbody>
          <?php
                    //impresion de las categorias
                    categoria::GenerarTablaCategoria($conexion);
              ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!--ventana modal agregar categoria-->
<div class="modal fade" id="modal-agregar-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="md-form" name="nombreCat">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtNombreCat" id="txtNombreCat" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtNombreCat">Nombre de la categoria</label>
              <div id="mensaje1" name="mensaje1" class="well error-form text-center"> Error, campo vacio, ingrese el nombre de la categoria.</div>
            </div>

            <div class="md-form" name="descipcionCat">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txtDescripcionCat" id="txtDescripcionCat" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtDescripcionCat">Descripcion de categoria</label>
              <div id="mensaje2" name="mensaje2" class="well error-form text-center"> Error, campo vacio, ingrese la descripcion de la categoria.</div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-GuardarCat" name="btn-GuardarCat"  class="btn btn-primary">Guardar Categoria Nueva</button>
          </div>
    </div>
  </div>
</div>

<!--ventana modal Editar categoria-->
<div class="modal fade" id="modal-editar-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="md-form" name="nombreCat">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txt-editarNombreCat" id="txt-editarNombreCat" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtNombreCat">Nombre de la categoria</label>
              <div id="mensaje3" name="mensaje3" class="well error-form text-center"> Error, campo vacio, ingrese el nombre de la categoria.</div>
            </div>

            <div class="md-form" name="descipcionCat">
              <i class="fas fa-pencil-alt prefix"></i>
              <textarea name="txt-editarDescripcionCat" id="txt-editarDescripcionCat" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtDescripcionCat">Descripcion de categoria</label>
              <div id="mensaje4" name="mensaje4" class="well error-form text-center"> Error, campo vacio, ingrese el nombre de la categoria.</div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-editarCat" name="btn-editarCat"  class="btn btn-primary">Actualizar Categoria Nueva</button>
          </div>
    </div>
  </div>
</div>



<!-- Editable table -->
  <!-- Start your project here-->

  <!-- SCRIPTS --> 
  
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/controlador_categorias.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  
</body>

</html>
