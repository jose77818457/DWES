<?php
use function UI\run;
    session_start();
   
    //Comprobamos que la compra no viene a vacia
    if (isset($_POST['compra'])) {
        //Rescatamos los datos enviados por el formulario
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        //Se valida que exista un producto seleccionado
        if($producto != null && $producto != ""){
            /* Creamos un array con el producto seleccionado para iniciar la sesion y además creamos el string del producto que es la suma del precio 
                en funcion de la cantidad enviada y concatenaremos el producto (nombre-precio) + cantidad y quedaría así (nombreProducto-precio-cantidad), este
                string nos servirá cada vez que se lance el formulario de inicio para ir añadiendo productos  */
            if($cantidad > 1){
                $lineaPorProducto = getProducto($producto) . '-' . getPrecio($producto) * $cantidad . '-' . $cantidad;
            }else{
                $lineaPorProducto = $producto . '-' . $cantidad;
            }
            $arrayPrimeraLinea = array($lineaPorProducto);
            /*Comprobamos que la sesión existe, si no existe la crea añadiendo el array con la primera linea a la sesion y si existe, entra por el flujo para continuar
             añadiendo productos a la sesion usando el string "lineaPorProducto" */
            if(isset( $_SESSION['listaProductos'])){
                /*Creamos un array auxiliar que nos permitirá modificar los productos si estan duplicados, mientras tanto añadimos la "lineaPorProducto" 
                  al array de la sesión, luego recorremos el array de la sesion y lo pasamos al auxiliar*/
                $auxiliar = array();
                array_push($_SESSION['listaProductos'], $lineaPorProducto);
                for($i = 0 ; $i < count($_SESSION['listaProductos']) ; $i++){
                    $auxiliar[$i] = $_SESSION['listaProductos'][$i];
                }
                /*El siguiente paso es buscar dentro del auxiliar los elementos duplicados y lo guardamos*/
                $elementoBorrar = encuentraDuplicado($auxiliar);
                $elementoModificado = "";
                /*Si ha encontrado algun elemento duplicado, se unifica sumando la cantidad y el precio, de esta manera nunca existirá un elemento duplicado
                    ya que si por ejemplo existe cocacola y vuelves a añadir una, automaticamente cogerá ese producto y lo unificará*/ 
                if($elementoBorrar != ""){
                    $elementoModificado = editDuplicados($elementoBorrar, $lineaPorProducto);
                }
                /*Creamos la lista oficial de productos, esta nos servirá para guardar los elementos no duplicados y además añadir el producto modificado 
                    ( que es el guardamos y editamos anteriormente) */
                $listaOficial = array();
                for($i = 0 ; $i < count($auxiliar) ; $i++){
                    if(getProducto($auxiliar[$i]) != getProducto($elementoBorrar)){
                        $listaOficial[$i] = $auxiliar[$i];
                    }
                }
                if($elementoModificado != ""){
                    array_push($listaOficial, $elementoModificado);
                }     
                /*Ahora actualizamos la lista de los productos de la sesion, machacando la anterior por la nueva
                    Por lo tanto, en la sesión no habrá duplicados y tendrá el resultado correcto.
                    
                    Esto significa que la el array $auxiliar se actualiza al principio y tendrá lo mismo que la "listaOficial", cuando 
                    se vuelva a enviar un producto, volverá a realizar el mismo proceso, si un producto ya existe, lo modifica*/                                                                      
                $_SESSION['listaProductos'] = $listaOficial;
            }else{               
                $_SESSION['listaProductos'] = $arrayPrimeraLinea;
            }
        }
              
    }
    
    function getProducto($elementoLista) {
        $info = explode( '-', $elementoLista);
        return $info[0];
    }
    function getPrecio($elementoLista){
        $info = explode( '-', $elementoLista);
        return $info[1];
    }
    function getCantidad($elementoLista) {
        $info = explode( '-', $elementoLista);
        return $info[2];
    }
    function editPrecio($valor1, $valor2) {
        $info = explode('-', $valor1);
        return ($info[1] + $valor2);
    }
    function editCantidad($valor1, $valor2) {
         $info = explode('-', $valor1);
         return ($info[2] + $valor2);
    }
    function encuentraDuplicado($auxiliar){
        $arrayProducto = array();
        for($i = 0 ; $i < count($auxiliar) ; $i++){
            $arrayProducto[$i] = getProducto($auxiliar[$i]);
        }
        $unique = array_unique($arrayProducto);
        if($unique != null){
            $duplicados = array_diff_assoc($arrayProducto, $unique);
            if($duplicados != null){
                foreach($duplicados as $dup){
                    foreach($auxiliar as $aux){
                        if(getProducto($aux) == getProducto($dup)){
                            return $aux;
                        }
                    }
                }
            }
        }
    }
    function editDuplicados($elementoModificar, $lineaPorProducto){
        $aux = getProducto($elementoModificar) . '-' .editPrecio($elementoModificar, 
            getPrecio($lineaPorProducto)) . '-' . editCantidad($elementoModificar, getCantidad($lineaPorProducto)); 
        return $aux;  
    }
      
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initialscale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
            div {
                text-align: center;
            }
            hr {
                border: 1px solid magenta;
            }
        </style>
    </head>
    <body>
        <div class='card-header'>
            <h1>Carrito de Compra</h1>
        </div>
        <div class='card-body card-text'>
            <table class='table table-striped table-dark'>
                <thead class='thead-dark'>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <hr>
                <?php
                //Aqui se recoge de la sesion el array con todos los productos y se pintará en la tabla 
                    if (isset($_SESSION['listaProductos'])) {
                        $carritoProductos = $_SESSION['listaProductos'];
                        for ($i = 0; $i < count($carritoProductos); $i++) {
                            /*Cada linea (producto-precio-cantidad) se convierte en un array de 3 posiciones 
                            siendo producto la 0, precio la 1 y cantidad la 2*/
                            $info = explode('-', $carritoProductos[$i]);
                            if ($i == 0) {
                                //Primer valor que obtendremos.
                                $_SESSION['total'] = ($info[2]);
                            } else {
                                //Sumaremos a ella misma la sesión.
                                $_SESSION['total'] += ($info[2]);
                            }
                            echo "<td>" . $info[0] . "</td>";
                            echo "<td>" . $info[1] . "</td>";
                            echo "<td>" . $info[2] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
            <hr>
        </div>
        <div class='card-footer'>
            <?php
                if (isset($_SESSION['listaProductos'])) {
                    echo '<h3><em>' . 'Total de productos: ' . $_SESSION['total'] . '</em></h3>';
                }
            ?>
            <br><br>
            <a href='inicio.php' class='btn btn-dark'>Seguir comprando</a>
            <a href='pedidos.php' class='btn btn-dark'>Realizar pedido</a>
        </div>
    </body>
</html>
