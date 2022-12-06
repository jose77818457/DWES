<?php
//Abrir conexión con la base de datos y seleccionar la base de datos a la que queramos conectarnos.
  require_once('connectionDatabase.php');
  $conexion = new ConnectionDatabase();
?>


<!DOCTYPE html>
<html>
 
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Práctica 2</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='facturas.css'>
</head>
 
<body style="background-color:#ece3f6;">
  

<nav class="navbar navbar-dark bg-dark justify-content-between">
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link" href="./regalos.php">Regalos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./niños.php">Niños</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="./reyes.php">Reyes</a>
  </li>
  </ul>
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>
<div class="container">
<table class="table">
<thead class="thead-info">
<tr>
<h1>Melchor</h1>
    <th scope="col">Regalos</th>
    
</tr>
</thead>
<?php

$sql = "SELECT * from regalos where idReyFK = 1";

$result = mysqli_query($conexion->getConnetion(), $sql);

while ($mostrar = mysqli_fetch_array($result)) {
?>
<tbody>
<tr>
    <td><?php echo $mostrar['nombreRegalo'] ?></td>
    
    
</tr>
</tbody>
<?php
}
?>
<tfoot>
<tr>
<th scope="col">Precio Total</th>
<tr>
<?php
$sqlPrecio = "SELECT SUM(precioRegalo) as total from regalos where idReyFK = 1";

$resultPrecio = mysqli_query($conexion->getConnetion(), $sqlPrecio);

while ($mostrar = mysqli_fetch_array($resultPrecio)) {
?>
<tr>
    <td><?php echo $mostrar['total'] ?>€</td>
    
</tr>
</tfoot>
<?php
}
?>
</table>
</div>



<p>  <hr width=1000></p>
<div class="container">
<table class="table">
<thead class="thead-info">
<tr>
  <h1>Gaspar</h1>
    <th scope="col">Regalos</th>
</tr>
</thead>
<?php

$sql1 = "SELECT * from regalos where idReyFK = 2";

$result1 = mysqli_query($conexion->getConnetion(), $sql1);

while ($mostrar = mysqli_fetch_array($result1)) {
?>
<tbody>
<tr>
    <td><?php echo $mostrar['nombreRegalo'] ?></td>
    
</tr>
</tbody>
<?php
}
?>
<tfoot>
<tr>
<th scope="col">Precio Total</th>
<tr>
<?php
$sqlPrecio1 = "SELECT SUM(precioRegalo) as total from regalos where idReyFK = 2";

$resultPrecio1 = mysqli_query($conexion->getConnetion(), $sqlPrecio1);

while ($mostrar = mysqli_fetch_array($resultPrecio1)) {
?>
<tr>
    <td><?php echo $mostrar['total'] ?>€</td>
    
</tr>
</tfoot>
<?php
}
?>
</table>
</div>


<p> <hr width=1000></p>



<div class="container">
<table class="table">
<thead class="thead-info">
<tr>
<h1>Baltasar</h1>
    <th scope="col">Regalos</th>
</tr>
</thead>
<?php

$sql2 = "SELECT * from regalos where idReyFK = 3";

$result2 = mysqli_query($conexion->getConnetion(), $sql2);

while ($mostrar = mysqli_fetch_array($result2)) {
?>
<tbody>
<tr>
    <td><?php echo $mostrar['nombreRegalo'] ?></td>
 
    
</tr>
</tbody>
<?php
}
?>
<tfoot>
<tr>
<th scope="col">Precio Total</th>
<tr>
<?php
$sqlPrecio2 = "SELECT SUM(precioRegalo) as total from regalos where idReyFK = 3";

$resultPrecio2 = mysqli_query($conexion->getConnetion(), $sqlPrecio2);

while ($mostrar = mysqli_fetch_array($resultPrecio2)) {
?>
<tr>
    <td><?php echo $mostrar['total'] ?>€</td>
    
</tr>
</tfoot>
<?php
}
?>
</table>
</div>
</body>
 

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>