<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Login</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!--  CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design  -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
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
  <!-- form login -->
  <div class="form">
      <h1>Sistema de Evaluacion Cocesna</h1>
      <form role="form" method="POST" name="login" accept-charset="UTF-8" enctype="application/x-www-form-urlencoded" autocomplete="off">
        <div class="field-wrap">
          <div class="form-group input-group"><span id="basic-addon1" class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" id="user" name="username" placeholder="Username" aria-describedby="basic-addon1" class="form-control" />
          </div>
        </div>
        

        <div class="field-wrap">
          <div class="form-group input-group"><span id="basic-addon2" class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" id="pass" name="password" placeholder="Password" aria-describedby="basic-addon2" autocomplete="off" class="form-control" />
          </div>
        </div><br>
        <button type="button" class="btn btn-danger button button-block" onclick="logInUsuario()">Acceder</button>
      </form>
      <div id="mensaje1" name="mensaje1" class="well error-form text-center"> Error, Usuario no existente o Contraseña incorrecta</div>
    </div>
  <!-- fin log in  -->
  <!-- Start your project here-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/controlador_usuarios.js"></script>
  <!-- Tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</body>

</html>
