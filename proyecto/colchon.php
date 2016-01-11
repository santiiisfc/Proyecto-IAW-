<?php
  session_start();
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
      <a class="navbar-brand" href="main.php"><span class="glyphicon glyphicon-home"></span></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="sofa.php">SOFÁS</a></li>
        <li><a href="dormitorio.php">DORMITORIOS</a></li>
        <li><a href="salon.php">SALÓN</a></li>
        <li><a href="cocina.php">COCINA</a></li>
        <li><a href="banio.php">BAÑO</a></li>
        <li><a class="active" href="#">COLCHONES</a></li>
        <li><a href="decoracion.php">DECORACIÓN</a></li>
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
          user='".$_POST["user"]."' and passw=md5('".$_POST["password"]."');";
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

<div class="container">
  <div class="col-sm-12">
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                <li><a href="#tab2default" data-toggle="tab">Default 2</a></li>
            </ul>
        </div>

          <div class="panel-body">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab1default">
              
              
               <?php
        //FORM SUBMITTED
       
          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          $consulta="select * from producto;";
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
              } else {
                while($f=$result->fetch_object()){

                     //echo "<script type=\"text/javascript\">alert('entra');</script>";       
                  
                    
            echo '<div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading">'.$f->NOMBRE.'</div>
                    <div class="panel-body"><img src="'.$f->IMAGEN.'" class="img-responsive" style="width:100%" alt="Image"></div>
                    <div class="panel-footer">Buy 50 mobiles and get a gift card</div>
                  </div>
                </div>';


                }

              }
          } 
      
    ?>







              </div>
               <div class="tab-pane fade in" id="tab2default">





            </div>
          </div>
    </div>
  </div>
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