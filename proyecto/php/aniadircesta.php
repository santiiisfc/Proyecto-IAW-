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

$result = "SELECT * FROM cesta, usuario
 WHERE CESTA.IDUSUARIO = USUARIO.IDUSUARIO AND CESTA.IDPRODUCTO = $id and USUARIO.USERNAME = '$usu'";


  if ($result = $connection->query($consulta)) {
    if ($result->num_rows===0) {

      $consulta"INSERT INTO cesta VALUES($id,$usu,$cantidad)";

        $connection->query($consulta);

    } else {
      $consulta = "UPDATE cesta SET cantidad = cantidad+1 WHERE IDPRODUCTO = $id";

      $connection->query($consulta);


      }
  }



?>
