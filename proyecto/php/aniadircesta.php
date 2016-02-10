<?php
session_start();

$connection = new mysqli("localhost", "root", "", "muebles");
if ($connection->connect_errno) {
  printf("Connection failed: %s\n", $connection->connect_error);
  exit();
}


$id=$_POST["idpro"];

$usu = $_SESSION["user"];

$cantidad=0;

$consulta = "SELECT * FROM cesta, usuario
WHERE CESTA.IDUSUARIO = USUARIO.IDUSUARIO AND CESTA.IDPRODUCTO = $id and USUARIO.USERNAME = '$usu'";


if ($result = $connection->query($consulta)) {
  if ($result->num_rows===0) {

    
    $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

    if($result=$connection->query($consultausu)){
      while($f=$result->fetch_object()){
        $idusu=$f->IDUSUARIO;
      }
    }



    $consulta="INSERT INTO cesta VALUES($id,$idusu,1)";

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

    $consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

    if($result=$connection->query($consultausu)){
      while($f=$result->fetch_object()){
        $idusu=$f->IDUSUARIO;
      }
    }
    
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
