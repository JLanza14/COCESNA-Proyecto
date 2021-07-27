<?php 
require_once('class/class_conexion.php');
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
          <!-- Font Awesome -->
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
          <!-- Bootstrap core CSS -->
          <link href="css/bootstrap.min.css" rel="stylesheet">
          <!-- Material Design Bootstrap -->
          <link href="css/mdb.min.css" rel="stylesheet">
          <!-- Your custom styles (optional) -->
          <link href="css/style.css" rel="stylesheet">
        <title>Reporte general</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    </head>
    <body>
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
<!--/.Navbar -->  
        <canvas id="myChart" style="width: auto;
                                    height: auto;"></canvas>
    </body>
    <script>
        var ctx= document.getElementById("myChart").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"bar",
            data:{
                labels:[<?php
                $sql = "SELECT nombre_cat, COUNT(*) AS PreguntasXCategoria FROM pregunta left JOIN categoria_pregunta ON pregunta.categorias_id_categoria = categoria_pregunta.id_categoria INNER JOIN log_encuestas ON pregunta.id_pregunta = log_encuestas.preguntas_id_pregunta GROUP BY nombre_cat";
                $result = $conexion->ejecutarInstruccion($sql);  
                while ($registros= $conexion->obtenerFila($result))
                 { ?>
                 
                 '<?php  echo $registros["nombre_cat"]  ?>',
                 
                 <?php 
                }            ?>


                ],
                datasets:[{
                        label:'Preguntas Respondidas Por Categoria',
                        data: 
                        <?php  $sql = "SELECT nombre_cat, COUNT(*) AS PreguntasXCategoria FROM pregunta left JOIN categoria_pregunta ON pregunta.categorias_id_categoria = categoria_pregunta.id_categoria INNER JOIN log_encuestas ON pregunta.id_pregunta = log_encuestas.preguntas_id_pregunta GROUP BY nombre_cat";
                        $result = $conexion->ejecutarInstruccion($sql);  
                        ?>
                        [<?php
                        while ($registros= $conexion->obtenerFila($result)){
                  ?> <?php  echo $registros["PreguntasXCategoria"]  ?>,
                 
                 <?php }
                 backgroundColor:[
                        'rgb(66, 134, 244,0.5)',
                        'rgb(74, 135, 72,0.5)',
                        'rgb(229, 89, 50,0.5)',
                            
                           
                            
                        ]
                ?>]

                        
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
    </script>
</html>