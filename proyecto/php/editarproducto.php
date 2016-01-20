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

//echo '<table class="table-striped  col-md-12" ><thead><tr><th>TIPO</th><th>NOMBRE</th><th>COLOR</th><th>ANCHO</th><th>ALTO</th><th>PROFUNDO</th><th>PRECIO</th><th>DESCUENTO</th><th>PRECIO DESCUENTO</th><th>IMAGEN</th></thead>';

//$consultatodo="SELECT * from producto;";
$consulta="SELECT * from producto WHERE '".$_POST["idp"]."';";



//var_dump($consulta);
//  var_dump($_POST["tipo"]);
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



            /*   $tip=$f->TIPO;
               $nom=$f->NOMBRE;
               $col=$f->COLOR;
               $anc=$f->ANCHO;
               $alt=$f->ALTO;
               $pro=$f->PROFUNDO;
               $prec=$f->PRECIO;
               $dec=$f->DESCUENTO;
               $prec_d=$f->PRECIO_DESCUENTO;
               $ima=$f->IMAGEN;*/

               $est=$f->ESTADO;



}

}
}else{
  echo $connection->error;

}

//echo $consulta.'    '.$_POST["tipo"].'    '.$_POST["nombre"];

echo "</table>";


?>
