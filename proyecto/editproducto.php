<?php
  session_start();
  ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }

    /* Remove the jumbotron's default bottom margin */
     .jumbotron {
      margin-bottom: 0;
    }

    /* Add a gray background color and some padding to the footer */
    footer {
	  background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>MUEBLES ELI</h1>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      </button>
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="producto.php">PRODUCTOS</a></li>
        <li><a href="pedido.php">PEDIDOS</a></li>
        <li><a href="usuario.php">USUARIOS</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

<?php if (!isset($_SESSION["user"])) : ?>

      <li>
      <form id="signin" class="navbar-form navbar-right" role="form" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="user" type="text" class="form-control" name="user" value="" placeholder="Email Address">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" value="" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
      </form>



 <?php
        //FORM SUBMITTED
        if (isset($_POST["user"])) {
          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from usuario where
          username='".$_POST["user"]."' and passw=md5('".$_POST["password"]."');";
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
              } else {
                while($f=$result->fetch_object()){

                  $r=$f->ROL;


                }
                //VALID LOGIN. SETTING SESSION VARS
                $_SESSION["user"]=$_POST["user"];
                $_SESSION["rol"]=$r;
                header("Location: main.php");
              }
          } else {
            echo "Wrong Query";
          }
      }
    ?>

      </li>

        <?php else: ?>

<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION["user"]; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="./main.php?logout=yes" id="logout">Cerrar sesión</a></li>
              <li><a href="#">Ver perfil</a></li>
            </ul>
          </li>


              <?php
              if (isset($_GET["logout"])) {
                  session_destroy();
                  header("Location: main.php");

              }

            ?>
              <?php if ($_SESSION["rol"]=="user") : ?>
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
              <?php else: ?>

              <?php endif ?>

        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>


  <?php if (isset($_SESSION["user"])) : ?>
    <div class="container">
      <div class="col-sm-12">


       <form method="post" action="#">
                    <fieldset>
                            <legend>Perfil</legend>
                    <table>
                        <tr>

       <?php
        //FORM SUBMITTED
        if (isset($_SESSION["user"])) {

                                               // echo "<script type=\"text/javascript\">alert('entra');</script>";

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
        //  $id=$_GET['id'];
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from producto where
          IDPRODUCTO ='".$_GET['id']."';";

          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
              } else {
                                                                  //echo "<script type=\"text/javascript\">alert('entra');</script>";

                while($f=$result->fetch_object()){


                   echo '
                            <td><input type="text" name="nom" value="'.$f->NOMBRE.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="passw" name="col" value='.$f->COLOR.' ></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="anc" value="'.$f->ANCHO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="alt" value="'.$f->ALTO.'"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="pro" value="'.$f->PROFUNDO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="pre" value="'.$f->PRECIO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="des" value="'.$f->DESCUENTO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="predes" value="'.$f->PRECIO_DESCUENTO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="imagen" value="'.$f->IMAGEN.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="tipo" value="'.$f->TIPO.'"> </td>
                        </tr>
                        <tr>
                            <td><input type="text" name="est" value="'.$f->ESTADO.'"> </td>
                        </tr>
                    </table>
                    </fieldset>
                    <br>
                    <input type="submit" name="send" value="enviar">
              </form>';


                }
                //VALID LOGIN. SETTING SESSION VARS
               // $_SESSION["user"]=$_POST["user"];
            //    $_SESSION["rol"]=$r;
              //  header("Location: main.php");
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
                        $preciodescuento = $_POST['predes'];
                        $imagen = $_POST['imagen'];
                        $tipo = $_POST['tipo'];
                        $estado = $_POST['est'];



                        $connection = new mysqli("localhost","root","","muebles");
                                    if ($connection->connect_error) {
                                        printf("Connection failed: %s\n", $mysqli->connect_error);
                                        exit();
                                    }
                        $consulta="UPDATE PRODUCTO SET NOMBRE='".$nombre."', COLOR='".$color."', ANCHO='".$ancho."' ,ALTO='".$alto."', PROFUNDO ='".$profundo."', PRECIO= '".$precio."', DESCUENTO='".$descuento."', PRECIO_DESCUENTO = '".$preciodescuento."', IMAGEN='".$imagen."', TIPO ='".$tipo."', ESTADO='".$estado."' WHERE NOMBRE  = '".$nombre."'";

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


<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
<?php
ob_end_flush();
?>
