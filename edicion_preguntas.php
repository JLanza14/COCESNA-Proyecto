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
  <title>Edicion Preguntas</title>
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
<?php
          $id_cate = $_GET['id_cate'];
          $sql = sprintf("SELECT 
                  id_categoria, 
                  nombre_cat, 
                  descripcion 
                  FROM categoria_pregunta
                  
                  WHERE id_categoria = '%s'",stripslashes($id_cate));
          $categoria = $conexion->ejecutarInstruccion($sql);
          $fila_categoria = $conexion->obtenerFila($categoria);       
?>

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Preguntas Categoria <?php echo $fila_categoria['nombre_cat'] ?></h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a data-toggle="modal" data-target="#modal-agregar-Pregunta" href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i>Agregar Nueva Pregunta</a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Preguntas</th>
            <th class="text-center">Cambios</th>
          </tr>
        </thead>
        <tbody>
        <?php
                    //impresion de las categorias
                    categoria::GenerarPreguntasxCategoria($conexion,$id_cate);
        ?>          

        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Editable table -->

<!--ventana modal agregar Pregunta-->
<div class="modal fade" id="modal-agregar-Pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Pregunta a Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
            <div class="md-form" name="Pregunta">
              <textarea name="txtPregunta" id="txtPregunta" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtPregunta">Escribe la pregunta</label>
              <div id="mensaje1" name="mensaje1" class="well error-form"> Error, campo vacio, ingrese la pregunta que desea agregar.</div>
            </div>
            <textarea style="display:none;" name="Categoriaid" id="Categoriaid" class="md-textarea form-control" rows="2"><?php echo $fila_categoria["id_categoria"]; ?></textarea>
            <label for='tipo-respuesta'>Seleccione el tipo de respuesta</label>
                 <?php
                    categoria::GenerarTipoRespuesta($conexion);
                  ?>  
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-GuardarPreguntaCat" name="btn-GuardarPreguntaCat"  class="btn btn-primary">Guardar Pregunta</button>
          </div>
    </div>
  </div>
</div>

<!--ventana modal Editar Pregunta-->
<div class="modal fade" id="modal-Editar-Pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Pregunta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
            <div class="md-form" name="Pregunta">
              <textarea name="txt-editarPregunta" id="txt-editarPregunta" class="md-textarea form-control" rows="2"></textarea>
              <label for="txtPregunta">Escribe la pregunta</label>
              <div id="mensaje2" name="mensaje2" class="well error-form"> Error, campo vacio, ingrese la pregunta que desea agregar.</div>
            </div>    
            <div align="center">
              <label for='select-categoria'>Seleccione categoria a la que pertenece</label>
                 <?php
                    categoria::GenerarCategoriasSelect($conexion);
                  ?>
            </div>
            <div align="center">
                  <label for='tipo-respuesta'>Seleccione el tipo de respuesta</label>
                 <?php
                    categoria::GenerarTipoRespuestaActualizar($conexion);
                  ?>
            </div>
            
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btn-EditarPreguntaCat" name="btn-EditarPreguntaCat"  class="btn btn-primary">Actualizar Pregunta</button>
          </div>
    </div>
  </div>
</div>
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
