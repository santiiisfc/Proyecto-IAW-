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
  <link rel="stylesheet" href="./css/estilos.css">
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
            //header("Location: main.php");
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
                  <a href="#">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
                </li>
                <?php else: ?>

                  <?php endif ?>

                    <?php endif ?>
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
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			                <input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<input type="text" name="color" id="color"  class="form-control input-sm" placeholder="color">
			    					</div>
			    				</div>
			    			</div>

                <div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			                <input type="number" name="ancho" id="ancho"  class="form-control input-sm" placeholder="ancho">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<input type="number" name="alto" id="alto"  class="form-control input-sm" placeholder="alto">
			    					</div>
			    				</div>
			    			</div>

                <div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			                <input type="number" name="profundo" id="profundo" class="form-control input-sm" placeholder="profundo">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<input type="number" name="precio" id="precio"  class="form-control input-sm" placeholder="precio">
			    					</div>
			    				</div>
			    			</div>

                <div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			                <input type="number" name="descuento" id="descuento" class="form-control input-sm" placeholder="descuento">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    					<input type="number" name="preciodescuento" id="preciodescuento" class="form-control input-sm" placeholder="preciodescuento">
			    					</div>
			    				</div>
			    			</div>

                <div class="row">
                 <div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
                  <div class="col-xs-6 col-sm-6 col-md-4">
			    			<div class="form-group">
			    		<input type="text" name="imagen" id="imagen"  class="form-control input-sm" placeholder="imagen">
			    			</div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
                <div class="col-xs-6 col-sm-6 col-md-4">
              <div class="form-group">
                <input type="text" name="tipo" id="tipo"  class="form-control input-sm" placeholder="tipo">
              </div>
              </div>
                </div>

			    			<div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-1">
			    					<div class="form-group">
			                <span class="glyphicon glyphicon-envelope">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-4">
			    					<div class="form-group">
			    						<input type="text" name="estado" id="estado"  class="form-control input-sm" placeholder="estado">
			    					</div>
			    				</div>
			    			</div>

			    			<input type="submit" value="add" class="btn btn-primary col-sm-offset-10">

			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>



        <?php
          if (isset($_POST["nombre"])){



          $nombre=$_POST["nombre"];
          $color=$_POST["color"];
          $ancho=$_POST["ancho"];
          $alto=$_POST["alto"];
          $profundo=$_POST["profundo"];
          $precio=$_POST["precio"];
          $descuento=$_POST["descuento"];
          $preciodescuento=$_POST["preciodescuento"];
          $imgen=$_POST["imagen"];
          $tipo=$_POST["tipo"];
          $estado=$_POST["estado"];

//echo "<script type=\"text/javascript\">alert('$nombre');</script>";
//echo "<script type=\"text/javascript\">alert('$apellidos');</script>";
//echo "<script type=\"text/javascript\">alert('$correo');</script>";
//echo "<script type=\"text/javascript\">alert('$username');</script>";
//echo "<script type=\"text/javascript\">alert('$passw');</script>";
          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
      //    $consulta="SELECT * from usuario where
        //  username='$username' or correo='$correo';";
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
              //No rows returned
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
                $consulta="INSERT INTO PRODUCTO VALUES(NULL,'$nombre','$color',$ancho,$alto,$profundo,$precio,$descuento,$preciodescuento,'$imagen','$tipo','$estado')";

                if($connection->query($consulta)){
                  //echo "<script type=\"text/javascript\">alert('entra');</script>";


                  header("Location: producto.php");
                }else{
                  var_dump($connection->error);
                  var_dump($consulta);
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
