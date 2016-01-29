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


      table {
        margin-bottom: 30px;


      };

      table tbody tr td {
        padding: 10px 0px;
        border: solid red 1px;

      };
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
            <li><a href="producto.php">PRODUCTOS</a></li>
            <li class="active"><a href="#">PEDIDOS</a></li>
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
      <div class="col-sm-12">

         <table class="table-striped  col-md-12" >

           <thead>
                   <tr>
                     <th>NOMBRE</th>
                     <th>precio</th>
                     <th>cantidad</th>
                 </thead>



                <?php
        //FORM SUBMITTED

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

          $USU = $_SESSION['user'];
          $consultausu = " SELECT P.NOMBRE, P.PRECIO, C.CANTIDAD, U.IDUSUARIO, C.IDPRODUCTO  FROM USUARIO U, CESTA C, PRODUCTO P WHERE U.IDUSUARIO = C.IDUSUARIO AND P.IDPRODUCTO = C.IDPRODUCTO AND U.USERNAME = '$USU' ;";


          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consultausu)) {
              //No rows returned
              if ($result->num_rows===0) {
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
              } else {
                while($f=$result->fetch_object()){

                     //echo "<script type=\"text/javascript\">alert('entra');</script>";


                     echo "<tr>";
                               echo "<td>".$f->NOMBRE."</td>";
                               echo "<td>".$f->PRECIO."</td>";
                               echo "<td>".$f->CANTIDAD."</td>";
                               echo "</tr>";

                               $id = $f->IDPRODUCTO;




                }
                echo '<form action="#" method="post"><input type="hidden" id="idpro" name="idpro" value="'.$id.'"> <button type="submit" id="enviar" class="btn btn-primary" >COMPRAR</button></form>';


              }
          }

    ?>

</table>

<?php
//echo "<script type=\"text/javascript\">alert('$usu');</script>";

  if (isset($_POST["idpro"])){
    //echo "<script type=\"text/javascript\">alert('$usu');</script>";


  $usu = $_SESSION["user"];
  $idpro=$_POST["idpro"];


//echo "<script type=\"text/javascript\">alert('$idpro');</script>";
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


  $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

  if($result=$connection->query($consultausu)){
    while($f=$result->fetch_object()){
      $idusu=$f->IDUSUARIO;
    }
  }


  $result = "SELECT MAX(IDPEDIDO) as maximo FROM PEDIDO;";
  if ($result = $connection->query($result)) {
      if ($result->num_rows===0) {
        $maximo=1;
      } else {
        while($f=$result->fetch_object()){
          $maximo=$f->maximo+1;


        }
      }
  }

$total=0;

  $importetotal = "SELECT C.CANTIDAD, P.PRECIO FROM CESTA C, PRODUCTO P WHERE C.IDPRODUCTO=P.IDPRODUCTO and IDUSUARIO = $idusu";

  if($result=$connection->query($importetotal)){
    while($f=$result->fetch_object()){

    $total=  $total + ($f->CANTIDAD)*($f->PRECIO);

    }
  }else{

    echo $connection->error;
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
        $consulta="INSERT INTO PEDIDO VALUES($maximo,$idusu,CURRENT_TIMESTAMP,$total)";

        if($connection->query($consulta)){
          //echo "<script type=\"text/javascript\">alert('entra');</script>";

            $con="SELECT * FROM CESTA WHERE IDUSUARIO =$idusu";
            if($result=$connection->query($con)){
              while($f=$result->fetch_object()){

                  $idpro=$f->IDPRODUCTO;
                //  $idusu=$f->IDUSUARIO;
                  $cant=$f->CANTIDAD;


                  $insertlinea="INSERT INTO LINEAPEDIDO VALUES(NULL,$maximo,$idpro,$cant);";
                  $connection->query($insertlinea);
              }
              $borrarcesta="DELETE FROM CESTA WHERE IDUSUARIO =$idusu";
              $connection->query($borrarcesta);
              header("Location: main.php");


            }



        }else{
          var_dump($connection->error);
          var_dump($consulta);
        }


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
