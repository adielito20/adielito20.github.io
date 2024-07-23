

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
    crossorigin="anonymous">
    
    
    <link rel="stylesheet" href="css/nosotros.css">
    <title>COMPUPLANET</title>
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


    <!-- SLIDER -->

    <section class="publicidad">

        <div class="carrsuselp">
            <div class="carruselp-items">
                <div class="carruselp-item">
                    <a href="index.html"><img src="imagenes/monitor11.jpg"></a>
                    <h3 class="titulo-imagen">MONITORES</h3>
                </div>
                <div class="carruselp-item">
                    <a href="index.html"><img src="imagenes/monitor22.jpg"></a>
                    <h3 class="titulo-imagen">COMPONENTES</h3>
                </div>
                <div class="carruselp-item">
                    <a href="Servicios.html"><img src="imagenes/monitor333.jpg"></a>
                    <h3 class="titulo-imagen">SERVICIO TECNICO</h3>
                </div>
                <div class="carruselp-item">
                    <a href="index.html"><img src="imagenes/monitor44.jpg"></a>
                    <h3 class="titulo-imagen">VENTA-COMPUTADORAS</h3>
                </div>

                <div class="carruselp-item">
                    <a href="index.html"><img src="imagenes/monitor55.jpg"></a>
                    <h3 class="titulo-imagen">REPUESTOS</h3>
                </div>

                <div class="carruselp-item">
                    <a href="index.html"><img src="imagenes/publicidad_1.jpg"></a>
                </div>

            </div>
        </div>

    </section>
    <script src="js/script.js"></script>

    <br>
    <hr>

    <!-- PRODUCTOS DESTACADOS -->
    <section class="prod-destacados">
        <h1>COMPUPLANET, Tecnologia a tu alcance</h1>

        <div class="resena">
            <div class="imag-r">
                <img src="imagenes/compuplanet.jpg" alt="">
            </div>
            <div class="parrafo-r">
                <p>En COMPUPLANET, nuestra misión es brindarte soluciones completas para tus necesidades tecnológicas y, al mismo tiempo, cuidar de tu economía y la de tu familia. Además de ofrecer las mejores marcas al mejor precio del mercado, también te garantizamos un servicio técnico excepcional. Nuestro equipo de expertos está listo para ayudarte con cualquier problema o consulta que puedas tener con tus dispositivos.
                    <br><br>
                Sabemos lo importante que es mantener tus equipos en óptimas condiciones, por lo que contamos con un servicio técnico altamente capacitado y comprometido en proporcionarte soluciones rápidas y efectivas. Ya sea que necesites una reparación, una actualización de software o simplemente asesoramiento, estamos aquí para ayudarte.
                    <br><br>
                En COMPUPLANET, nos esforzamos por ser tu aliado tecnológico de confianza, brindándote no solo productos de calidad garantizada, sino también un servicio integral que se preocupa por tu bienestar económico y tu satisfacción. ¡Confía en nosotros para todas tus necesidades tecnológicas y experimenta la diferencia!
                </p>
            </div>
        </div>
    </section>
    <br>
    <hr>

       <section class="s-marcas">
        <h3>NUESTRAS MARCAS</h3>
        <div class="contenedor-marcas">
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_1.PNG" width="250" height="150" alt="">
            </div>
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_2.PNG" width="250" height="150" alt="">
            </div>
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_3.PNG" width="250" height="150" alt="">
            </div>
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_4.PNG" width="250" height="150" alt="">
            </div>
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_5.PNG" width="250" height="150" alt="">
            </div>
            <div class="item-marca">
                <img src="imagenes/Imag_marcas/marca_6.PNG" width="250" height="150" alt="">
            </div>
        </div>
    </section>

    <!-- BOTON WHATSAPP -->
    <div class="contenedor-wp">
        <a href="https://wa.me/51943812989?text=COMPUPLANET ¿En qué te podemos ayudar?" target="_blank">
            <img class="btn-wp" src="imagenes/icono_whatsapp.png" alt="icono-whatsapp">
        </a>
    </div>
    <hr>

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
                <li><a href="product.html">Productos</a></li>
                <li><a href="codigo.html">Nosotros</a></li>
                <li><a href="contactenos1.html">Contáctenos</a></li>
                <li><a href="inicio_sesion.html">Iniciar Sesión</a></li>
            </ul>
        </div>

        <div class="legal-footer">
            <p>Copyright &copy;2023; Derechos Reservados: Taller de Programación Web con Anaximandro</p>
        </div>
    </footer>
</body>
</html>
