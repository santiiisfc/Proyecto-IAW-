<?php
session_start();

$connection = new mysqli("localhost", "root", "", "muebles");
//TESTING IF THE CONNECTION WAS RIGHT
if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
//MAKING A SELECT QUERY
//Password coded with md5 at the database. Look for better options
//Test if the query was correct
//SQL Injection Possible
//Check http://php.net/manual/es/mysqli.prepare.php for more security

 $id=$_POST["idpro"];

$usu = $_SESSION["user"];

$cantidad=0;

$consulta = "SELECT * FROM cesta, usuario
 WHERE CESTA.IDUSUARIO = USUARIO.IDUSUARIO AND CESTA.IDPRODUCTO = $id and USUARIO.USERNAME = '$usu'";


  if ($result = $connection->query($consulta)) {
    if ($result->num_rows===0) {

    //$idusu;
    $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

    if($result=$connection->query($consultausu)){
      while($f=$result->fetch_object()){
        $idusu=$f->IDUSUARIO;
      }
    }

//echo $idusu;
    //echo $consultausu;

      $consulta="INSERT INTO cesta VALUES($id,$idusu,1)";

    //  echo $consulta;

      if(  $resulta = $connection->query($consulta)){
        $consultacant ="SELECT sum(cantidad) as total  FROM CESTA WHERE IDUSUARIO = $idusu ;";
        if($result=$connection->query($consultacant)){
          while($f=$result->fetch_object()){
            $cant=$f->total;
          }
        }
          echo $cant;

      }else{
        echo $connection->error;
      }

    } else {
      //echo $idusu;
      $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

      if($result=$connection->query($consultausu)){
        while($f=$result->fetch_object()){
          $idusu=$f->IDUSUARIO;
        }
      }
    //  echo $idusu;
      $consulta = "UPDATE cesta SET cantidad = cantidad+1 WHERE IDPRODUCTO = $id and IDUSUARIO = $idusu";

      $connection->query($consulta);

      $consultacant ="SELECT sum(cantidad) as total  FROM CESTA WHERE IDUSUARIO = $idusu ;";
      if($result=$connection->query($consultacant)){
        while($f=$result->fetch_object()){
          $cant=$f->total;
        }
      }
        echo $cant;


      }
  }



?>
