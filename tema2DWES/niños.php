<?php
use LDAP\Result;

require_once('connectionDatabase.php');
$conexion = new ConnectionDatabase();
$ninio = new Ninio();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Práctica 2</title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel='stylesheet' type='text/css' media='screen' href='facturas.css'>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
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
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Fecha Nacimiento</th>
          <th scope="col">¿Ha sido Bueno?</th>
        </tr>
      </thead>
      <?php
      //Recogida de esos datos con la variable $result.
      $result = $ninio->selectAll($conexion);
      //Almacenar datos en un array a través de la función fetch_array, en la variable $mostrar.
      //$mostrar = mysqli_fetch_array($result);
      while ($mostrar = mysqli_fetch_array($result)) {
      ?>
      <form action="#" method="post">
        <tbody>
          <tr>
            <td>
              <?php echo $mostrar['nombreNinio'] ?>
            </td>
            <td>
              <?php echo $mostrar['apeNinio'] ?>
            </td>
            <td>
              <?php echo $mostrar['fechaNacimientoNinio'] ?>
            </td>
            <td>
              <?php echo $mostrar['buenoSiNo'] ?>
            </td>
            <td>
              <input id="del" class="btn btn-primary" type="submit" name="delete" value="delete" />
              <script>
                document.getElementById('del').onclick=function(){
                  
                };
              </script>
              
            </td>
          </tr>
        </tbody>
      </form>
      <?php
      }
      ?>
    </table>
    <form action="#" method="post">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control" required type=text name="nombre" form-control-name="" size=32 maxlength=128>
      </div>
      <div class="form-group">
        <label>Apellidos</label>
        <input class="form-control" required type=text name="apellidos" size=32 maxlength=128>
      </div>
      <div class="form-group">
        <label>Fecha de Nacimiento</label>
        <input class="form-control" required data-date-format="yyyy-mm-dd" type="date" name="fecha" />
      </div>
      <div class="form-group">
        <label>Bueno</label>
        <select class="custom-select" name="bueno">
          <option selected value="Si"> Si
          <option value="No"> No
        </select>
      </div>
      <input id="add" class="btn btn-primary" type="submit" value="submit">
      <input class="btn btn-primary" type="reset" value="Reset">
      <?php
      if (!isset($_POST['submit'])) {
        //echo $ninio->exist($_POST, $conexion) . "?=?";
        if ($ninio->exist($_POST, $conexion) == true) {
          echo " ya existe en la base de datos.";
          unset($_POST);
          $_POST = array();
        } else {
          $ninio->insert($_POST, $conexion);
          unset($_POST);
          $_POST = array();
        }
      }
      ?>
    </form>
  </div>

</body>
<?php

class Ninio
{
  public function selectAll($conexion)
  {
    $sql = "SELECT idNinio ,nombreNinio, apeNinio, DATE_FORMAT(fechaNacimientoNinio, '%d-%m-%Y') as fechaNacimientoNinio, buenoSiNo from ninios ORDER BY 1";
    $result = mysqli_query($conexion->getConnetion(), $sql);
    return $result;
  }

  public function exist($data, $conexion)
  {
    $existe = false;
    $nombre = $data['nombre'];
    $apell = $data['apellidos'];
    $sql = 'select * from ninios where nombreNinio LIKE ("' . $nombre . '") AND apeNinio LIKE ("' . $apell . '")';
    $result = mysqli_query($conexion->getConnetion(), $sql);
    $mostrar = mysqli_fetch_array($result);
    if ($mostrar != null && !empty($mostrar)) {
      $existe = true;
    }
    return $existe;
  }

  public function select($ID, $conexion)
  {
    $sql = 'SELECT * FROM ninios WHERE idNinio = ' . (int) $ID;
    $rows = $this->$conexion->query($sql);
    if ((int) $rows->num_rows) {
      $row = $rows->fetch_assoc();
    } else {
      $row = null;
    }
    return $row;
  }

  public function insert($data, $conexion)
  {
    $nombre = $data['nombre'];
    $apell = $data['apellidos'];
    $fNac = $data['fecha'];
    $bueno = $data['bueno'];
    echo $nombre;
    $sql = "INSERT INTO `ninios` (`idNinio`, `nombreNinio`, `apeNinio`, `fechaNacimientoNinio`, `buenoSiNo`) VALUES 
    (DEFAULT,'$nombre', '$apell', '$fNac', '$bueno')";
    mysqli_query($conexion->getConnetion(), $sql);
    echo '<script type="text/javascript">
          document.location = "niños.php?" 
          if ( window.history.replaceState ) {
              window.history.replaceState( null, null, window.location.href );
          }
          </script>';
  }

  public function update($data, $conexion)
  {
    if (empty($data['nombre'])) {
      throw new Exception('Debe rellenar el campo de NOMBRE.');

    } else {
      $sql = 'UPDATE juguetes SET nombre =
    "' . $data['nombre'] . '", precio = "' . $data['precio'] . '" WHERE id =
    ' . (int) $data['id'];
      $this->$conexion->query($sql);
      return (int) $data['id'];
    }
  }

  public function delete($ID, $conexion)
  {
    $sql = 'DELETE FROM juguetes WHERE id = ' . (int) $ID;
    mysqli_query($conexion->getConnetion(), $sql);
  }
}

?>




</html>