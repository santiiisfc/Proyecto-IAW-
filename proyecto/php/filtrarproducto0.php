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

echo '<table class="table-striped  col-md-12" ><thead><tr><th>TIPO</th><th>NOMBRE</th><th>COLOR</th><th>ANCHO</th><th>ALTO</th><th>PROFUNDO</th><th>PRECIO</th><th>DESCUENTO</th><th>PRECIO DESCUENTO</th><th>IMAGEN</th></thead>';

//$consultatodo="SELECT * from producto;";
$primera=0;
$consulta="SELECT * from producto";


if(isset($_POST["nombre"]) && ($_POST["nombre"]) != ''){
  $primera=1;
  $consulta =$consulta." WHERE NOMBRE like '".$_POST["nombre"]."%'";

}

if(isset($_POST["tipo"]) && $_POST["tipo"]!="todo"){
  if($primera==0  ){
    $consulta =$consulta." WHERE TIPO = '".$_POST["tipo"]."';";

  }else{
      $consulta =$consulta." AND TIPO = '".$_POST["tipo"]."';";
  }
  }

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
               echo "</tr>";


}

}
}else{
  echo $connection->error;

}

echo $consulta.'    '.$_POST["tipo"].'    '.$_POST["nombre"];

echo "</table>";


?>
