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
  <title>Pregunta Clave</title>
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
          <a class="nav-link" id="navbarDropdownMenuLink-4" aria-haspopup="true" aria-expanded="false">
          <?php echo "Supervisor: ".$_SESSION['nombre_usuario']; ?>
          </a>
        </li>
      </ul>
    </div>
  </nav>
<!--/.Navbar -->


    <div>
        <div class="col-md-10 mb-4" 
             style="width: 2000px;
             position: absolute;
             top: 215px;
             left: 13%;
             margin-left: -70px;">

          <div class="card text-center" style="background-color: rgba(229, 228, 255, 0.2);">
              <div class="card-header">
                <p class="white-text">Bienvenido al sistema de encuestas Cocesna</p>
              </div>
              <div class="card-body" align="center">
                <div class="md-form" style="width: 500px " >
                  <input type="text" class="form-control white-text" name="txtUserH" id="txtUserH">
                  <label for="txtUserH" class="white-text">Ingrese el Usuario al que esta ayudando</label>
                </div>
                <div id="mensaje1" name="mensaje1" class="well error-form text-center"> Error, Usuario no existente</div>
                <button type="submit" id="btn-revisionUsuario"  name="btn-revisionUsuario" class="btn btn-primary">Ir a pregunta clave</button>
                </div>             
              </div>
              <div class="card-footer text-muted">
                <p class="white-text"></p>
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
