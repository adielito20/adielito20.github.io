


<?php
//session_start();
//session_destroy();



require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();



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

?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">

    <link rel="stylesheet" href="css/Estilo_MedioPago.css">
    
    <title>MediosDePago</title>
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
        </header><br><br><br>

    <!-- Contenido de la página -->
    <main>
        <h1>En Compuplanet contamos con estas opciones de pago:</h1>
        <h2>Tarjetas:</h2>
        <p>Compuplanet te brinda la comodidad de elegir entre una amplia gama de tarjetas de crédito y débito para realizar tus compras, lo que te permite utilizar tus tarjetas favoritas con total seguridad. Nuestros sistemas de pago están diseñados para garantizar transacciones sin problemas y proteger la información financiera de nuestros clientes.</p>
            <!-- Primera fila con 4 espacios para imágenes -->
            <div class="payment-methods">
            <div class="payment-method">
                <img src="imagenes\pago\tarjeta_visa.png" alt="Visa">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\tarjeta_mastercard.png" alt="MasterCard">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\tarjeta_amex.png" alt="American Express">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\paypal.png" alt="PayPal">
            </div>
            </div>
            <!-- Segunda fila con 4 espacios para imágenes -->
        <h2>Bancos:</h2>
        <p>En Compuplanet, entendemos la importancia de la elección de un banco de confianza para tus transacciones financieras. Colaboramos con bancos líderes para ofrecerte opciones bancarias seguras y eficientes. Puedes realizar pagos directamente desde tu cuenta bancaria con total tranquilidad y confianza en la seguridad de tus datos.</p>
            <div class="payment-methods">
            <div class="payment-method">
                <img src="imagenes\pago\BBVA.png" alt="BBVA">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\BCP.png" alt="Banco de Crédito del Perú">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\Interbank.png" alt="Interbank">
            </div>
            <div class="payment-method">
                <img src="imagenes\pago\Scotiabank.png" alt="Scotiabank">
            </div>
            </div>
            <!-- Tercera fila con 2 espacios para imágenes -->
        <h2>Billeteras digitales:</h2>
        <p>En un mundo digital en constante evolución, Compuplanet se mantiene a la vanguardia al ofrecer métodos de pago modernos y ágiles. Nuestras opciones de billeteras digitales incluyen dos soluciones de pago populares en el Perú. Estas billeteras te permiten realizar transacciones rápidas y seguras desde tu dispositivo móvil, brindándote la flexibilidad que necesitas en tus compras en línea.</p>
            <div class="payment-methods">
            <div class="payment-method2">
                <img src="imagenes\pago\Yape.png" alt="Yape">
            </div>
            <div class="payment-method2">
                <img src="imagenes\pago\Plin.png" alt="Plin">
            </div>
            </div>
    </main><br><br><br><br>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

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
            <li><a href="index.php">Inicio</a></li>
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