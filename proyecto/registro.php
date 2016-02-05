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

  h1{
    background-color:#b69b87; 
    padding-left: 20px;
    color:white;

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
  src: url('c.ttf');

}

p{
  font-family: 'a',sans-serif;
  color:white;
  font-size: 50px;
}

</style>
</head>

<body>

  <div class="jumbotron" id="header">
    <div class="container text-center">
      <p>japon mamon saluda a la aficion</p>
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





  <div class="container">
    <div class="row centered-form">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-8">
       <div class="panel panel-default">
        <div class="panel-heading">
         <h3 class="panel-title">Datos personales</h3>
       </div>

       <div class="panel-body">
         <form role="form" method="post" action="#">
          <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-1">
              <div class="form-group">
               <span class="fa fa-user">
               </div>
             </div>

             <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="form-group">
               <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
             </div>
           </div>

           <div class="col-xs-6 col-sm-6 col-md-1">
            <div class="form-group">
             <span class="fa fa-user">
             </div>
           </div>

           <div class="col-xs-6 col-sm-6 col-md-4">
            <div class="form-group">
              <input type="text" name="apellidos" id="apellidos" class="form-control input-sm" placeholder="Apellidos">
            </div>
          </div>
        </div>

        <div class="row">
         <div class="col-xs-6 col-sm-6 col-md-1">
          <div class="form-group">
           <span class="fa fa-envelope">
           </div>
         </div>

         <div class="col-xs-6 col-sm-6 col-md-4">
          <div class="form-group">
           <input type="email" name="correo" id="correo" class="form-control input-sm" placeholder="Correo electrónico">
         </div>
       </div>

       <div class="col-xs-6 col-sm-6 col-md-1">
        <div class="form-group">
         <span class="fa fa-user">
         </div>
       </div>

       <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="form-group">
          <input type="text" name="username" id="username" class="form-control input-sm" placeholder="Nombre usuario">
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-1">
        <div class="form-group">
         <span class="fa fa-key">
         </div>
       </div>
       <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="form-group">
         <input type="password" name="passw" id="passw" class="form-control input-sm" placeholder="Contraseña">
       </div>
     </div>
   </div>

   <input type="submit" value="Registrarse" class="btn btn-primary col-sm-offset-10">

 </form>
</div>

</div>
</div>
</div>
</div>



<?php
if (isset($_POST["username"])){



  $nombre=$_POST["nombre"];
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
