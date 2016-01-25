<?php

$connection = new mysqli("localhost", "root", "", "muebles");

if ($connection->connect_errno) {
printf("Connection failed: %s\n", $connection->connect_error);
exit();
}

echo '<table class="table  col-md-12" ><thead><tr><th>TIPO</th><th>NOMBRE</th><th>COLOR</th><th>ANCHO</th><th>ALTO</th><th>PROFUNDO</th><th>PRECIO</th><th>DESCUENTO</th><th>PRECIO DESCUENTO</th><th>IMAGEN</th><th>EDITAR</th></thead>';

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

if ($result = $connection->query($consulta)) {
if ($result->num_rows===0) {
} else {
while($f=$result->fetch_object()){

  if($f->ESTADO == "no"){
  echo "<tr class='danger' >";
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
            echo "<td>".$f->ESTADO."</td>";
            echo "<td><a href='editproducto.php?id=$f->IDPRODUCTO'>editar</a></td>";
            echo "</tr>";

  }else{

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
            echo "<td>".$f->ESTADO."</td>";
            echo "<td><a href='editproducto.php?id=$f->IDPRODUCTO'>editar</a></td>";
            echo "</tr>";
  }
}
}
}else{
  echo $connection->error;
}

echo "</table>";

?>
