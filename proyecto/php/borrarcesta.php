

<?php
session_start();

$connection = new mysqli("localhost", "root", "", "muebles");
if ($connection->connect_error) {
  printf("Connection failed: %s\n", $mysqli->connect_error);
  exit();
}

$usu = $_SESSION["user"];

$id=$_POST['idpro'];  

//echo $id;

$consultausu = " SELECT *  FROM USUARIO WHERE USERNAME = '$usu'";

if($result1=$connection->query($consultausu)){
  while($f=$result1->fetch_object()){
    $idusu=$f->IDUSUARIO;
  }
}else{

 echo $connection->error;
}

$consulta1 = "SELECT *  FROM CESTA where IDPRODUCTO = $id AND IDUSUARIO= $idusu;";
if ($result2 = $connection->query($consulta1)) {
  if ($result2->num_rows===0) {

  } else {

    while($f=$result2->fetch_object()){
      $cant=$f->CANTIDAD;

      
      if($cant>1){
        $consulta2="UPDATE CESTA SET CANTIDAD=$cant-1 WHERE IDPRODUCTO=$id";
        $result3=$connection->query($consulta2);

       // header("Location: vercesta.php");

      }else{
        $consulta3 ="DELETE FROM CESTA WHERE IDPRODUCTO =$id;";
        $result4=$connection->query($consulta3);
        //header("Location: vercesta.php");

      }
    }


  }
}else{

echo  $connection->error;
}


    $tabla = '<table class="table-bordered table-striped col-md-12" ><thead><tr><th>NOMBRE</th><th>PRECIO</th><th>CANTIDAD</th></thead>';




       $connection = new mysqli("localhost", "root", "", "muebles");
       if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
      }

      $USU = $_SESSION['user'];
      $consultatabla = " SELECT P.NOMBRE, P.PRECIO, C.CANTIDAD, U.IDUSUARIO, C.IDPRODUCTO  FROM USUARIO U, CESTA C, PRODUCTO P WHERE U.IDUSUARIO = C.IDUSUARIO AND P.IDPRODUCTO = C.IDPRODUCTO AND U.USERNAME = '$USU' ;";



      if ($result4 = $connection->query($consultatabla)) {
        if ($result4->num_rows===0) {
        } else {
          while($f=$result4->fetch_object()){



            $tabla =$tabla.'<tr><td>'.$f->NOMBRE.'</td><td>'.$f->PRECIO.'</td><td>'.$f->CANTIDAD.'</td><td><button  class="btn btn-danger" onclick="borrarcesta('.$f->IDPRODUCTO.')" >Eliminar</button></td></tr>';

           $id = $f->IDPRODUCTO;




         }
         $tabla=$tabla.'<form action="#" method="post"><input type="hidden" id="idpro" name="idpro" value="'.$id.'"><button type="submit" id="enviar" class="btn btn-primary" >COMPRAR</button></form>';


       }
     }

    

  $tabla =$tabla."</table>";
//  echo $tabla;

$consultacount="SELECT SUM(CANTIDAD) AS CONT FROM CESTA WHERE IDPRODUCTO = $id AND IDUSUARIO = $idusu";

$total =$connection->query($consultacount);

while($f=$total->fetch_object()){

      $contcesta=$f->CONT;
}


$datos = array("1" => $tabla, "2" =>$contcesta );

echo json_encode($datos);

?>