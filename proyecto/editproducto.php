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
  <script src="./javascript/funcionesproductos.js"></script>

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
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="producto.php">PRODUCTOS</a></li>
          <li><a href="usuario.php">USUARIOS</a></li>
          <li><a href="pedido.php">PEDIDOS</a></li>
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




<?php if (isset($_SESSION["user"])) : ?>
  <div class="container">
    <div class="row centered-form">


     <form style="padding-bottom:30px;" method="post" action="#">
      <div>
        <h2 id="titulo">DATOS PRODUCTO</h2>
      </div>


      <?php
      if (isset($_SESSION["user"])) {


        $connection = new mysqli("localhost", "root", "", "muebles");
        if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
        }

        $consulta="select * from producto where
        IDPRODUCTO ='".$_GET['id']."';";


        if ($result = $connection->query($consulta)) {
          if ($result->num_rows===0) {
          } else {

            while($f=$result->fetch_object()){


             echo '
             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>NOMBRE PRODUCTO </label>
             </br>
             <input type="text" name="nom" value="'.$f->NOMBRE.'" required> 
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>COLOR </label>
             </br>
             <input type="text" name="col" value="'.$f->COLOR.'" required>
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>ANCHO </label>
             </br>
             <input type="number" name="anc" value='.$f->ANCHO.' required>
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>ALTO </label>
             </br>
             <input type="number" name="alt" value='.$f->ALTO.' required>
             </div>
             </div>
             </div>
             

             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>PROFUNDO </label>
             </br>
             <input type="number" name="pro" value='.$f->PROFUNDO.' required>              
             </div>
             </div>
             </div>

             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>PRECIO </label>
             </br>
             <input type="number" name="pre" value='.$f->PRECIO.' required>              
             </div>
             </div>
             </div>



             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>DESCUENTO </label>
             </br>
             <input type="number" name="des" value='.$f->DESCUENTO.' required>
             </div>
             </div>
             </div>';
             



             echo'
             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <img id="preview" src="'.$f->IMAGEN.'" style="width:100%;height:100%;" required/>

             <input type="file" name="img" id="img"  />
             </div>
             </div>
             </div>';



             echo '
             <div class="row">
             <div class="col-md-4 col-md-offset-4">
             <div class="form-group">
             <label>TIPO </label>
             </br>
             <input type="text" name="tipo" value="'.$f->TIPO.'"> 
             </div>
             </div>
             </div>';

             if($f->ESTADO=="activo"){

              echo '
              <div class="row">
              <div class="col-md-4 col-md-offset-4">
              <div class="form-group">
              <label>ESTADO </label>
              <div class="radio">
              <label>
              <input type="radio" name="estado" id="optionsRadios1" value="activo" checked>
              ACTIVO
              </label>
              </div>';

              echo "<div class='radio'>
              <label>
              <input type='radio' name='estado' id='optionsRadios1' value='no activo'>
              NO ACTIVO
              </label>
              </div>
              </div>
              </div>
              </div>"
              ;

            }else{

              echo '
              <div class="row">
              <div class="col-md-4 col-md-offset-4">
              <div class="form-group">
              <label>ESTADO </label>
              <div class="radio">
              <label>
              <input type="radio" name="estado" id="optionsRadios1" value="activo">
              ACTIVO
              </label>
              </div>';

              echo "<div class='radio'>
              <label>
              <input type='radio' name='estado' id='optionsRadios1' value='no activo' checked>
              NO ACTIVO
              </label>
              </div>
              </div>
              </div>
              </div>"
              ;

            }

            echo '
            <br>
            <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <div class="form-group">
            <input type="submit" name="send" value="Actualizar" class="btn btn-primary btn-lg btn-block">
            </div>
            </div>
            </div>
            </form>';


          }

        }
      }
    }
    ?>

  <?php else: ?>


<?php endif ?>

<?php
if (isset($_POST["nom"])) {

  $nombre = $_POST['nom'];
  $color = $_POST['col'];
  $ancho = $_POST['anc'];
  $alto= $_POST['alt'];
  $profundo = $_POST['pro'];
  $precio = $_POST['pre'];
  $descuento = $_POST['des'];
  $preciodescuento = $precio*$descuento/100;
  $pdescuento = $precio-$preciodescuento;
  $imagen = $_POST['img'];
  $tipo = $_POST['tipo'];
  $estado = $_POST['estado'];



  $connection = new mysqli("localhost","root","","muebles");
  if ($connection->connect_error) {
    printf("Connection failed: %s\n", $mysqli->connect_error);
    exit();
  }
  $consulta="UPDATE PRODUCTO SET NOMBRE='".$nombre."', COLOR='".$color."', ANCHO=".$ancho." ,ALTO=".$alto.", PROFUNDO =".$profundo.", PRECIO= ".$precio.", DESCUENTO=".$descuento.", PRECIO_DESCUENTO = ".$pdescuento.", IMAGEN='".$imagen."', TIPO ='".$tipo."', ESTADO='".$estado."' WHERE NOMBRE  = '".$nombre."'";

  echo $consulta;
  if($connection->query($consulta)==true){
    echo "perfe";
  }else{
    echo $connection->error;
  }
  unset($connection);
  header('Location: producto.php');

}
?>

</div>
</div>


<?php
include'./footer.php';
?>
<script language="javascript">

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#img").change(function(){
  alert('entaaaa');
  readURL(this);
});

</script>
</body>
</html>
<?php
ob_end_flush();
?>
