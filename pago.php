<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();
$productos =isset($_SESSION['carrito']['productos'])?$_SESSION['carrito']['productos']:null ;

//Extrear los productos que tenemos en la sesion
print_r($_SESSION);

$lista_carrita = array();
var_dump($productos);

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        // Obtener productos
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad, ruta_imagen FROM productos WHERE id = ?");
        $sql->execute([$clave]);
        $producto = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch en lugar de fetchAll
        $lista_carrito[] = $producto;
    }
} else{
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['usuario_nombre'])) {
    // Usuario ha iniciado sesión
    $nombre_usuario = $_SESSION['usuario_nombre'];
    $boton_iniciar_sesion = '<button class="btn btn-success">' . $nombre_usuario . '</button>';
    $boton_registro = '<button class="btn btn-danger"><a class="text-white" href="cerrar_sesion.php">Logout</a></button>';
} else {
    // Usuario no ha iniciado sesión
    $nombre_usuario = 'Iniciar Sesión';
    $boton_iniciar_sesion = '<button class="btn btn-success"><a class="text-white" href="inicio_sesion.php">Inicia sesión</a></button>';
    $boton_registro = '<button class="btn btn-primary"><a class="text-white" href="registro.php">Regístrate</a></button>';
}



//session_destroy();




?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/index.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Tienda Online</title>
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    



</head>
<body>
    <!--Barra de Navegacion-->
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 py-4">
                        <div class="logo">
                            <img src="imagenes/logotipo.png" alt="logo compuplanet">
                        </div>
                    </div>
                    <div class="col-sm-4  py-4 text-end">
                    <p>
                        <?php echo $boton_iniciar_sesion; ?> |||| 
                        <?php echo $boton_registro; ?>
                    </p>
                </div>
                </div>
            </div>
        </div>
        
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
              <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>COMPUPLANET</strong>
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
          </div>
          </div>
          <div class="contenedor_inferior">
                <nav>
                        <a class="op" href="index.php">Productos</a>
                        <a class="op" href="servicios.php">Servicios</a>
                        <a class="op" href="MedioPago.php">Medios de pago</a>
                        <a class="op" href="nosotros.php">Acerca de nosotros</a>
                        <button class="carrito" ><a class="carro" href="carrito_compras.php" >
                            CARRITO<span id="num_cart" class="badge bg-secondary"><?php echo $num_cart;    ?></span>
                            </a></button>       
                    </nav>
        </div>
        </header>

        <br>

<!--Contenido-->

<main>
    <div class="productos">

    <div class="row">
        <div class="col-6">
            <h4>Detalles de Pago</h4>
            <div id="paypal-button-container"></div>

        </div>

        <div class="col-6">
    
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($lista_carrito == null) {
                        echo '<tr><td colspan="5" class="text-center"><b>Lista vacía</b></td></tr>';
                    } else {
                        $total = 0;
                        foreach ($lista_carrito as $producto) {
                            $_id = $producto['id'];
                            $_nombre = $producto['nombre'];
                            $_precio = $producto['precio'];
                            $_descuento = $producto['descuento'];
                            $_cantidad = $producto['cantidad'];
                            $_precio_desc = $_precio - (($_precio * $_descuento) / 100);
                            $subtotal = $_cantidad * $_precio_desc;
                            $total += $subtotal;
                            ?>
                            <tr>
                                <td><?php echo $_nombre; ?></td>
                                
                                <td>
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                                </td>
                            </tr>
                    <?php } ?>
                       <tr>
                        <td colspan="2">
                            <p class="h3 text-end" id="total"><?php echo MONEDA.number_format
                            ($total,2,'.',',');?></p>
                        </td>

                       </tr> 
                </tbody>
                <?php }?>
            </table>
        </div>
       
            </div>
        </div>
    </div>
</main>






<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY;?>"></script>


<script>


    // Obtén el valor de PHP $total y asígnalo a una variable de JavaScript
    var totalCompra = <?php echo $total; ?>;


    paypal.Buttons({

        style:{
            color:'blue',
            shape:'pill',
            label: 'pay'
            
        },
        createOrder: function(data,actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 10000
                    }
                }]
            });
        },

        onApprove: function(data, actions){
            let URL = 'clases/captura.php'
            actions.order.capture().then(function(detalles){

                console.log(detalles)

                let url = 'clases/captura.php'

                return fetch(url, {
                method: 'post',
                headers: {
                    'content-type' : 'application/json'
                },
                body: JSON.stringify({
                    detalles: detalles
                })
            })


            });
        },


        onCancel: function(data){
            alert("Pago Cancelado");
            console.log(data);
        }


    }).render('#paypal-button-container')
</script>



 <!-- PIE DE PAGINA -->
 <footer class="pie-pagina">
    <div class="boletin">
        <div class="f-logo">
            <a href="#" class="a-pie">
                <img src="imagenes/logotipo.png" alt="" class="img-pie"> 
                <pre><h1 id="1">COMPUPLANET</h1></pre>
            </a>
        </div>
        <p class="parr-suscribete">Suscríbete y recibe consejos y tutoriales para el hogar, <br> publicidad y
            promociones comerciales directamente en tu <br> e-mail.</p>
        <div class="sus-boletin">
            <form action="">
                <label for="ingresa-correo" class="in-correo">
                    <input type="text" id="ingresa-corre" required value placeholder="Ingresa tu correo">
                </label>
                <button type="submit" class="btn-enviar"><ion-icon name="send"></ion-icon> Enviar</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="redes-sociales">
        <a target="_blank" href="https://www.facebook.com/CompuPlanetTumbes" class=""><span><ion-icon name="logo-facebook"></ion-icon></span></a>
        <a href="" class=""><span><ion-icon name="logo-twitter"></ion-icon></span></a>
        <a href="" class=""><span><ion-icon name="logo-instagram"></ion-icon></span></a>
        <a href="" class=""><span><ion-icon name="logo-youtube"></ion-icon></span></a>
    </div>

    <div class="menu-footer">
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="Servicios.html">Servicios</a></li>
            <li><a href="MedioPago.html">Medios de Pago</a></li>
            <li><a href="codigo.html">Acerca de Nosotros</a></li>
        </ul>
    </div>

    <div class="legal-footer">
        <p>Copyright &copy;2023; Derechos Reservados: Taller de Programación Web con Anaximandro</p>
    </div>
</footer>

    
</body>

</html>

