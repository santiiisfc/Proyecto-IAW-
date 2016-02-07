<?php
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
          <li class="active"><a href="#">SALÓN</a></li>
          <li><a href="cocina.php">COCINA</a></li>
          <li><a href="banio.php">BAÑO</a></li>
          <li><a href="colchon.php">COLCHONES</a></li>
          <li><a href="decoracion.php">DECORACIÓN</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

          <?php if (!isset($_SESSION["user"])) : ?>

          <li>
            <form id="signin" class="navbar-form navbar-right" role="form" method="POST">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="user" type="text" class="form-control" name="user" value="" size="15" placeholder="Usuario">
              </div>

              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input id="password" type="password" class="form-control" name="password" value="" size="15" placeholder="Contraseña">
              </div>

              <button type="submit" class="btn btn-primary">Login</button>
              <a href="registro.php" class="btn btn-success" role="button">Registro</a>
            </form>



            <?php
            if (isset($_POST["user"])) {
              $connection = new mysqli("localhost", "root", "", "muebles");
              if ($connection->connect_errno) {
                printf("Connection failed: %s\n", $connection->connect_error);
                exit();
              }

              $consulta="select * from usuario where
              username='".$_POST["user"]."' and passw=md5('".$_POST["password"]."');";

              if ($result = $connection->query($consulta)) {
                if ($result->num_rows===0) {
                } else {
                  while($f=$result->fetch_object()){

                    $r=$f->ROL;


                  }
                  $_SESSION["user"]=$_POST["user"];
                  $_SESSION["rol"]=$r;
                  if($r=='admin'){
                    header("Location: producto.php");
                  }else{
                    header("Location: main.php");
                  }

                }
              } else {
                echo "Wrong Query";
              }
            }
            ?>

          </li>

        <?php else: ?>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-user"></span>
            <?php echo $_SESSION["user"]; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./main.php?logout=yes" id="logout">Cerrar sesión</a></li>
              <li><a href="perfil.php">Ver perfil</a></li>
            </ul>
          </li>


          <?php
          if (isset($_GET["logout"])) {
            session_destroy();
            header("Location: main.php");

          }

          ?>
          <?php if ($_SESSION["rol"]=="user") : ?>
          <li>
            <a href="vercesta.php">
              <span class="glyphicon glyphicon-shopping-cart"></span> 
              <p id="cesta"style="float:right; margin-left:10px">

                <?php

                $usu = $_SESSION["user"];

                $connection = new mysqli("localhost", "root", "", "muebles");
                if ($connection->connect_errno) {
                  printf("Connection failed: %s\n", $connection->connect_error);
                  exit();
                }

                $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

                if($result=$connection->query($consultausu)){
                  while($f=$result->fetch_object()){
                    $idusu=$f->IDUSUARIO;
                  }
                }

                $consultacant ="SELECT sum(cantidad) as total  FROM CESTA WHERE IDUSUARIO = $idusu ;";
                if($result=$connection->query($consultacant)){
                  while($f=$result->fetch_object()){
                    $cant=$f->total;
                  }
                }
                echo $cant;
                ?>

              </p>

            </a>
          </li>
        <?php else: ?>

      <?php endif ?>

    <?php endif ?>
  </ul>
</div>
</div>
</nav>

<div class="container" style="background-color:#e0f4f3; margin-bottom:30px;">
  <div class="row">

    

    <?php

    $connection = new mysqli("localhost", "root", "", "muebles");
    if ($connection->connect_errno) {
      printf("Connection failed: %s\n", $connection->connect_error);
      exit();
    }

    $consulta="SELECT * FROM PRODUCTO WHERE TIPO = 'salon';";

    if ($result = $connection->query($consulta)) {
      if ($result->num_rows===0) {
      } else {
        while($f=$result->fetch_object()){


          echo '<div class="col-sm-4">
          <div class="panel" style="background-color:#b69b87; margin-bottom:20px; margin-top:20px; color:white;">
          <div class="panel-heading" >'.$f->NOMBRE.'</div>
          <div class="panel-body"><img src="'.$f->IMAGEN.'" class="img-responsive" style="width:100%" ></div>
          <form action="./detallespro.php" method="post"><input type="hidden" id="idpro" name="idpro" value="'.$f->IDPRODUCTO.'"> <div class="panel-footer" style="background-color:#f7f5f5;"><button type="submit" class="btn" style="background-color:#41c1c2; color:white;" ><span class="glyphicon glyphicon-shopping-cart white"></span> '.$f->PRECIO_DESCUENTO.' €</button></form>
          </div>
          </div>
          </div>';


        }

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