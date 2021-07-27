<?php
require_once('class/class_conexion.php');
$conexion = new Conexion();
session_start();
if(!isset($_SESSION['nombre_usuario'])||($_SESSION['inicio']==2))
    header("Location: index.php");
$busca=$_POST['busca'];
$sqlE = sprintf("SELECT id, username
                                FROM user1 
                             WHERE username = '%s'",
                            stripslashes($_POST["busca"]));

                 $resultadoE=$conexion->ejecutarInstruccion($sqlE);
                 $filaE = $conexion->obtenerFila($resultadoE);
$meh=$filaE["username"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Reporte Ultima Encuesta</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
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
        <?php 
        if($_SESSION['posicion']==3){
        echo "<a class='nav-link' href='Reportes.php'>Inicio";}
        else{
        echo "<a class='nav-link' href='index_admin.php'>Inicio";}
        ?>
          <span class="sr-only">(current)</span>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php 
                if($_SESSION['posicion']==4){
                echo "Administrador: ".$_SESSION['nombre_usuario'];}
                else{
                echo "Recursos Humanos: ".$_SESSION['nombre_usuario'];}
          ?>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
          <a class="dropdown-item" href="cerrar_sesion.php">Log out</a>
        </div>
      </li>
    </ul>
  </div>
</nav>

<?php
if($busca!="" and $busca==$meh){
$sql="SELECT encuesta_id_encuesta AS Encuesta,username,cat.nombre_cat,p.pregunta , respuesta FROM user1 
INNER JOIN log_encuestas ON user1.id = log_encuestas.user_id 
INNER JOIN pregunta p on log_encuestas.preguntas_id_pregunta=p.id_pregunta
inner join categoria_pregunta cat on cat.id_categoria =p.categorias_id_categoria
WHERE username = '$busca' AND encuesta_id_encuesta=(select encuesta_id_encuesta from log_encuestas 
where user_id = (select id from user1 where username='$busca') ORDER BY encuesta_id_encuesta DESC LIMIT 1);";
$busqueda=$conexion->ejecutarInstruccion($sql);
?>
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Reporte Ultima Encuesta</h3>
  <div class="card-body">
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Numero de la Ultima encuesta realizada</th>
            <th class="text-center">Nombre de usuario</th>
            <th class="text-center">Categorias Respondidas</th>
            <th class="text-center">Pregunta</th>
            <th class="text-center">Respuestas de cada pregunta</th>
          </tr>
        </thead>
        <tbody>
 
<?php

while($f=$conexion->obtenerFila($busqueda)){
?>
<tr>
    <td class="pt-3-half" contenteditable="false"><?php echo $f['Encuesta'];?></td>
    <td class="pt-3-half" contenteditable="false"><?php echo $f['username'];?></td>
    <td class="pt-3-half"><?php echo $f['nombre_cat'];?></td>
    <td class="pt-3-half"><?php echo $f['pregunta'];?></td>
    <td class="pt-3-half"><?php echo $f['respuesta'];?></td>

</tr>
<?php

}

}elseif($busca!=$meh or $meh==""){
  header("Location: reporte_personalizado.php?dv=1");
}
?>
 </tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

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