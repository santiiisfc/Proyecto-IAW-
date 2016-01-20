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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="./javascript/funcionesproductos.js"></script>

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
            <li class="active"><a href="#">PRODUCTOS</a></li>
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
      <div class="col-md-12">

        <div class="row">

          <div class="col-md-4">

          <?php
          $connection = new mysqli("localhost", "root", "", "muebles");
          $consultafiltro = "SELECT distinct TIPO FROM producto;";
          $consultafiltro = $connection->query($consultafiltro);


            echo "<select name='tipo' id='tableselect'>";
            echo "<option value='todo' selected>Ver todo</option>";

            while($f=$consultafiltro->fetch_object()){
                      echo "<option value='".$f->TIPO."'>".$f->TIPO."</option>";

                            }
            echo "</select>";
           ?>



        </div>

        <div class="col-md-8">
            <input type="text" name="filtro" id="busqueda" placeholder="busqueda" size="50"></input>
        </div>

      </div>

        <div class="row" id="tabla">

         <table class="table-striped  col-md-12" >

           <thead>
                   <tr>
                     <th>TIPO</th>
                     <th>NOMBRE</th>
                     <th>COLOR</th>
                     <th>ANCHO</th>
                     <th>ALTO</th>
                     <th>PROFUNDO</th>
                     <th>PRECIO</th>
                     <th>DESCUENTO</th>
                     <th>PRECIO DESCUENTO</th>
                     <th>IMAGEN</th>
                     <th>EDITAR</th>
                 </thead>



                <?php
        //FORM SUBMITTED

          //CREATING THE CONNECTION

          //$tip=$_POST["tipo"];
          $connection = new mysqli("localhost", "root", "", "muebles");
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //MAKING A SELECT QUERY
          //Password coded with md5 at the database. Look for better options

          $consulta="SELECT * from producto;";
        //  $consulta="SELECT * from producto";


          //if(isset($_POST["tipo"]) && $_POST["tipo"]!="todo"){
          //  $consulta =$consulta." WHERE TIPO = '".$_POST["tipo"]."';";
        //  }
          //var_dump($consulta);
        //  var_dump($_POST["tipo"]);
          //Test if the query was correct
          //SQL Injection Possible
          //Check http://php.net/manual/es/mysqli.prepare.php for more security
          if ($result = $connection->query($consulta)) {
              //No rows returned
              if ($result->num_rows===0) {
                //echo "<script type=\"text/javascript\">alert('entra');</script>";
                echo $consulta;
              } else {
                while($f=$result->fetch_object()){

                     //echo "<script type=\"text/javascript\">alert('entra');</script>";


                     echo "<tr>";
                               echo "<td>".$f->TIPO."</td>";
                               echo "<td>".$f->NOMBRE."</td>";
                               echo "<td>".$f->COLOR."</td>";
                               echo "<td>".$f->ANCHO."</td>";
                               echo "<td>".$f->ALTO."</td>";
                               echo "<td>".$f->PROFUNDO."</td>";
                               echo "<td>".$f->PRECIO."</td>";
                               echo "<td>".$f->DESCUENTO."</td>";
                               echo "<td>".$f->PRECIO_DESCUENTO."</td>";
                               echo "<td> <img src='".$f->IMAGEN."' height='42' width='42'/></td>";
                               echo "<td><a href='editproducto.php?id=$f->IDPRODUCTO'>editar</a></td>";
                               echo "</tr>";


                }

              }
          }

    ?>

</table>

</div>


      </div>
    </div>


    <?php
        include'./footer.php';
      ?>

  </body>

  </html>
