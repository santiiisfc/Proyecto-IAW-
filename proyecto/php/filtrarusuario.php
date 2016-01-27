<?php

$connection = new mysqli("localhost", "root", "", "muebles");

if ($connection->connect_errno) {
printf("Connection failed: %s\n", $connection->connect_error);
exit();
}

echo '<table class="table  col-md-12" ><thead><tr><th>NOMBRE USUARIO</th><th>NOMBRE</th><th>APELLIDOS</th><th>CORREO</th><th>ROL</th><th>ESTADO</th></thead>';

$primera=0;
$consulta="SELECT * from usuario";

if(isset($_POST["nombre"]) && ($_POST["nombre"]) != ''){
  $primera=1;
  $consulta =$consulta." WHERE NOMBRE like '".$_POST["nombre"]."%'";
}

if(isset($_POST["rol"]) && $_POST["rol"]!="todo"){
  if($primera==0  ){
    $consulta =$consulta." WHERE ROL = '".$_POST["rol"]."';";
  }else{
      $consulta =$consulta." AND ROL = '".$_POST["rol"]."';";
  }
  }

if ($result = $connection->query($consulta)) {
if ($result->num_rows===0) {
} else {
while($f=$result->fetch_object()){

  if($f->ESTADO == "no"){
  echo "<tr class='danger' >";
            echo "<td>".$f->USERNAME."</td>";
            echo "<td>".$f->NOMBRE."</td>";
            echo "<td>".$f->APELLIDOS."</td>";
            echo "<td>".$f->CORREO."</td>";
            echo "<td>".$f->ROL."</td>";
            echo "<td>".$f->ESTADO."</td>";
            echo "</tr>";

  }else{

  echo "<tr>";
  echo "<td>".$f->USERNAME."</td>";
  echo "<td>".$f->NOMBRE."</td>";
  echo "<td>".$f->APELLIDOS."</td>";
  echo "<td>".$f->CORREO."</td>";
  echo "<td>".$f->ROL."</td>";
  echo "<td>".$f->ESTADO."</td>";
  echo "</tr>";
  }
}
}
}else{
  echo $connection->error;
}

echo "</table>";

?>
