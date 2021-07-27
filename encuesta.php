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
  <title>Categorias y Preguntas</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body style="background: url(img/Fondo1.jpg);
             background-repeat: no-repeat;
             background-position: center center; 
             background-attachment: fixed;
             background-size: cover;
             background-size: cover;">

  <!-- Start your project here-->
  <!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar mask rgba-grey-strong img-fluid">
  <a class="navbar-brand" href="#"><img src="img/Cocesna-Logo.png" height="40" alt="mdb logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse " id="navbarSupportedContent-555">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        </li>
      </ul>
      <ul class="navbar-nav ml-auto nav-flex-icons">
         <li class="nav-item dropdown">
          <a class="nav-link" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php 
              if($_SESSION['posicion']==2){
              echo "Supervisor: ".$_SESSION['nombre_usuario'];}
              else{
              echo $_SESSION['nombre_usuario'];}
            ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
<!--/.Navbar -->  

<!-- Card -->
<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 d-flex flex-wrap" 
     style="top: 130px;
            margin-left: 15%;
            padding: 10px;">
              <?php
                categoria::GenerarCategoriasEncuesta($conexion);
              ?>
</div>
<!-- fin Card -->


<!--ventana Preguntas categoria-->
<div class="modal fade" id="modal-preguntas-categoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preguntas Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action= "envio_cate_encuesta.php" method="POST">
            <?php 
              if($_SESSION['posicion']==2){
                $sql = sprintf("SELECT id, username
                                FROM user1 
                             WHERE username = '%s'",
                            stripslashes($_POST["txtUserHelp"]));

                 $resultado=$conexion->ejecutarInstruccion($sql);
                 $fila = $conexion->obtenerFila($resultado);

              ?><input type="text" name="txtUserid" id="txtUserid" value="<?php echo  $fila["id"];?>" style="display: none">
                <input type="text" name="txtUsername" id="txtUsername" value="<?php echo  $fila["username"];?>" style="display: none">
              <?php
            }else{
              ?><input type="text" name="txtUserid" id="txtUserid" value="<?php echo  $_SESSION["id"];?>" style="display: none">
                <input type="text" name="txtUsername" id="txtUsername" value="<?php echo  $_SESSION["nombre_usuario"];?>" style="display: none">
              <?php
            }
              ?>
            
            <div name="PreguntasCategoriaX" id="PreguntasCategoriaX">

              
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="btn-guardarEncuesta"  name="btn-guardarEncuesta"  class="btn btn-primary">Enviar Categoria respondida</button>
          </div>
        </form>
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
