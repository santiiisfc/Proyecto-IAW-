
<?php
//FORM SUBMITTED

//CREATING THE CONNECTION

$tip=$_POST["tipo"];
$connection = new mysqli("localhost", "root", "", "muebles");
//TESTING IF THE CONNECTION WAS RIGHT
if ($connection->connect_errno) {
printf("Connection failed: %s\n", $connection->connect_error);
exit();
}
//MAKING A SELECT QUERY
//Password coded with md5 at the database. Look for better options
$consulta="SELECT * from producto WHERE TIPO = '$tip' ;";
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
}

?>
