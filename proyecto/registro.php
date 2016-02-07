<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Muebles Eli</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>

  .navbar {
    margin-bottom: 50px;
    border-radius: 0;
  }

  .jumbotron {
    margin-bottom: 0;
    background-color:#b69b87; 
  }

  footer {
    background-color: #3c393a;
    color: #b69b87;
    padding: 25px;
  }

  #titulo{
    background-color:#b69b87; 
    padding-left: 20px;
    color:white;
    font-family: 'a',sans-serif;
    margin-left:15px;
    margin-right:15px;

  }
  #nombre{
    color:white;
    font-family: 'a',sans-serif;

  }
  a{
    color: #ece7e1;

  }
  a:hover{
   color: #FFFFFF;
   

 }

 .social{

  margin-bottom: 10px;

}
.social:hover{
  text-decoration: none;
}

li{

  color: #ece7e1;

}

#header{
  background-image: url("./imagenes/b.PNG");
}


@font-face {
  font-family: 'a';
  src: url('./css/a.ttf');

}



</style>
</head>

<body style="background-color:#f7f5f5;">

  <div class="jumbotron" id="header">
    <div class="container text-center">
      <h1 id="nombre">ELI ´S DECORA</h1>
      <div class="alert alert-danger hidden" style="width:80%;margin: 0 auto;position:relative;top:-20px;height:60px;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong id="alert_msg">¡¡Ya existe un usuario con ese correo o nombre de usuario!!</strong>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="main.php">
          <span class="glyphicon glyphicon-home"></span>
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="sofa.php">SOFÁS</a></li>
          <li><a href="dormitorio.php">DORMITORIOS</a></li>
          <li><a href="salon.php">SALÓN</a></li>
          <li><a href="cocina.php">COCINA</a></li>
          <li><a href="banio.php">BAÑO</a></li>
          <li><a href="colchon.php">COLCHONES</a></li>
          <li><a href="decoracion.php">DECORACIÓN</a></li>
        </ul>
      </div>
    </div>
  </nav>




  <div class="container" style="background-color:#e0f4f3; margin-bottom:200px;">
    <div class="row centered-form">

     <form style="padding-bottom:30px;" role="form" method="post" action="#">

      <div>
        <h2 id="titulo">DATOS PERSONALES</h2>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <label>NOMBRE </label>
            <input type="text" name="nom" id="nom" class="form-control input-sm" placeholder="Nombre">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <label>APELLIDOS </label>
            <input type="text" name="apellidos" id="apellidos" class="form-control input-sm" placeholder="Apellidos">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <label>CORREO ELECTRÓNICO </label>
            <input type="email" name="correo" id="correo" class="form-control input-sm" placeholder="Correo electrónico">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <label>USUARIO </label>
            <input type="text" name="username" id="username" class="form-control input-sm" placeholder="Nombre usuario">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <label>CONTRASEÑA </label>
            <input type="password" name="passw" id="passw" class="form-control input-sm" placeholder="Contraseña">
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group">
            <input type="submit" value="Registrarse" class="btn btn-primary btn-lg btn-block">
          </div>
        </div>
      </div>
    </form>




  </div>
</div>



<?php
if (isset($_POST["username"])){



  $nombre=$_POST["nom"];
  $apellidos=$_POST["apellidos"];
  $correo=$_POST["correo"];
  $username=$_POST["username"];
  $passw=$_POST["passw"];

  $connection = new mysqli("localhost", "root", "", "muebles");
  if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
  }

  $consulta="SELECT * from usuario where
  username='$username' or correo='$correo';";

  if ($result = $connection->query($consulta)) {
    if ($result->num_rows===0) {
      $consulta="INSERT INTO usuario VALUES(NULL,'$username',md5('$passw'),'$nombre','$apellidos','$correo','user','activo')";

      if($connection->query($consulta)){

        $_SESSION["user"]=$_POST["username"];
        $_SESSION["rol"]='user';

        header("Location: main.php");
      }else{
        var_dump($connection->error);
        var_dump($consulta);
      }

    } else {
      unset($connection);
      echo '<script language="javascript">$(".alert").toggleClass("hidden").fadeIn(1000); window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();});}, 3000);</script>';

}
} else {
  echo "Wrong Query";
}
}





?>

</div>
</div>

<?php
include'./footer.php';
?>

</body>
</html>

<?php
ob_end_flush();
?>
