<!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initialscale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Pedidos</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        session_start();
        /*Iniciamos sesion con fecha y hora para usarlas en las cookies, luego comprobamos que tenemos el total de productos comprados
            para guardar las cookies*/
        $fecha = date('d') . '/' . date('m') . '/' . date('Y');
        $hora = date('H') . ':' . date('i') . ':' . date('s');
        if (isset($_SESSION['total'])) {
            /*Si la cookie idCompra existe, añadimos a la anterior +1 para autoincrementar el pedido, en caso que no, la cookie se inicializa por primera vez mm, 
                */
            if (isset($_COOKIE['idCompra'])) {
                setcookie('idCompra', ($_COOKIE['idCompra'] + 1), time() + 1000);
            } else {
                setcookie('idCompra', 1, time() + 1000);
            }
            /*Creamos la cookie historial que será la linea completa con el id, la fecha y el total de productos, si aun no existe la inicializamos con el id 0*/ 
            if (isset($_COOKIE['historial'])) {
                setcookie('historial', $_COOKIE['historial'] . '*' . $_COOKIE['idCompra'] . '-' . $fecha . ' a las ' . $hora . '-' . $_SESSION['total'], time() + 1000);
            } else {
                setcookie('historial', '0-' . $fecha . ' a las ' . $hora . '-' . $_SESSION['total'], time() + 1000);
            }
        }
    ?>
    <div class='card text-center'>
        <div class='card-header'>
            <h1>Lista de Pedidos Realizados</h1>
        </div>
        <div class='card-body card-text'>
            <table class='table table-striped table-dark'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <?php
                    if (isset($_COOKIE['historial']) && isset($_POST['buPedido'])) {
                        $arrayHistorial = explode('*', $_COOKIE['historial']);
                            for ($i = 0; $i < count($arrayHistorial) - 1; $i++) {
                                if ($i == 0) {
                                    $auxDatos = $arrayHistorial[$i];
                                } else {
                                    $auxDatos .= '*' . $arrayHistorial[$i];
                                }
                            }
                        if (count($arrayHistorial) > 1) {
                            setcookie('historial', $auxDatos, time() + 1000);
                        } else {
                            setcookie('idCompra', '', time() - 1);
                            setcookie('historial', '', time() - 1);
                        }
                        if (count($arrayHistorial) != 0) {
                            for ($i = count($arrayHistorial) - 2; $i >= 0; $i--) {
                                $datos = explode('-', $arrayHistorial[$i]);
                                    echo '<tr>';
                                    echo '<td>#' . $datos[0] . '</td>';
                                    echo '<td>' . $datos[1] . '</td>';
                                    echo '<td>' . $datos[2] . ' productos en total.</td>';
                                    echo '</tr>';
                            }
                        }
                    } elseif (isset($_COOKIE['historial'])) {
                        $arrayHistorial = explode('*', $_COOKIE['historial']);
                        for ($i = count($arrayHistorial) - 1; $i >= 0; $i--) {
                            $datos = explode('-', $arrayHistorial[$i]);
                            echo '<tr>';
                            echo '<td>#' . $datos[0] . '</td>';
                            echo '<td>' . $datos[1] . '</td>';
                            echo '<td>' . $datos[2] . ' productos en total.</td>';
                            echo '</tr>';
                        }
                    }
                    session_destroy();
                ?>
            </table>
            <a href='inicio.php' class='btn btndark'>Volver al inicio</a>
            <br><br>
             <form action='pedidos.php' method='POST'>
                <input type='hidden' name='buPedido'>
                <input type='submit' class='btn btndark' value='Borrar ultimo pedido'>
             </form>
            <br><br>
            <p>Actualizar para mostrar el valor de la cookie.<p>
        </div>
    </div>
</body>
