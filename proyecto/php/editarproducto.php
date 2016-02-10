<?php

$connection = new mysqli("localhost", "root", "", "muebles");

if ($connection->connect_errno) {
  printf("Connection failed: %s\n", $connection->connect_error);
  exit();
}

$consulta="SELECT * from producto WHERE '".$_POST["idp"]."';";


if ($result = $connection->query($consulta)) {
  if ($result->num_rows===0) {
  } else {
    while($f=$result->fetch_object()){

     $est=$f->ESTADO;



   }

 }
}else{
  echo $connection->error;

}


echo "</table>";


?>
