<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" 
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" 
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <style>
            .form-group {
            text-align: center;
            }
            select {
            width: 500px;
            }
        </style>
    </head>
    <body>
        <form action="carrito.php" method="POST">
            <div class="form-group">
                <h1> Lista de compra </h1>
                <select class="select" name="producto">
                <option value="">Elija una opcion</option> 
                    <option value="Cerveza Cruzcampo-1.20">Cerveza Cruzcampo-1.20€</option> 
                    <option value="Cocacola-1.30">Cocacola-1.30€</option>
                    <option value="Agua 1L-1">Agua 1L-1€</option> 
                    <option value="Aceite Virgen Extra 1L-4.95">Aceite Virgen Extra 1L-4.95€</option> 
                    <option value="Queso viejo Entrepinares 250g-2.60">Queso viejo Entrepinares 250g-2.60€</option> 
                    <option value="Lechuga icerberg-0.95">Lechuga icerberg-0.95€</option> 
                    <option value="Vino blanco 1L-1.8">Vino blanco 1L-1.8€</option> 
                    <option value="Piña eco-1.10">Piña eco-1.10€</option> 
                    <option value="Conserva Melva-1.90">Conserva Melva-1.90€</option> 
                    <option value="Conserva mejillones natural-1.45">Conserva mejillones natural-1.45€</option>  
                </select>
                <br><br>
                <h4><em>Cantidad:<em></h4>
                <input type="number" class="formcontrol" name="cantidad" min="1" value="1">
                <br><br>
                <input type="submit" name="compra" class="btn btn-dark">
            </div>
        </form> 
    </body>
</html>
