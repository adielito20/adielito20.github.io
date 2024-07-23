
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

    <link rel="stylesheet" href="css/Estilo_Servicios.css">
    <title>Servicios</title>
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


    <!-- Primer Servicio -->
    <div class="service first-service">
        <section class="service-container"> 
            <div class="image">
                <img src="imagenes\ReparacionHardware.png" width="500" height="500" alt="imagenReparacionHardware">
            </div>
            <div class="contenido">
                <h2>Reparación de Hardware</h2>
                <p>Ofrecemos reparación de hardware para computadoras, laptops y dispositivos móviles. Nuestros técnicos altamente capacitados pueden solucionar problemas de hardware y reemplazar componentes dañados.</p>
                <button id="abrirModal1" class="solicitar-button">Solicitar Servicio</button>
            </div>
        </section>
    </div>

    <!-- Segundo Servicio -->
    <div class="service second-service">
        <section class="service-container"> 
            <div class="image">
                <img src="imagenes\MantenimientoSoftware.png" width="500" height="500" alt="imagenMantenimientoSoftware">
            </div>
            <div class="contenido">
                <h2>Mantenimiento de Software</h2>
                <p>Ofrecemos reparación de hardware para computadoras, laptops y dispositivos móviles. Nuestros técnicos altamente capacitados pueden solucionar problemas de hardware y reemplazar componentes dañados.</p>
                <button id="abrirModal2" class="solicitar-button">Solicitar Servicio</button>
            </div>
        </section>
    </div>

    <!-- Tercer Servicio -->
    <div class="service third-service">
        <section class="service-container"> 
            <div class="image">
                <img src="imagenes\SoporteTecnicoRemoto.png" width="500" height="500" alt="SoporteTecnicoRemoto">
            </div>
            <div class="contenido">
                <h2>Soporte Técnico Remoto</h2>
                <p>Ofrecemos soporte técnico remoto para ayudarte a resolver problemas de software de manera rápida y efectiva. Nuestros expertos pueden acceder de forma segura a tu computadora para solucionar problemas en tiempo real.</p>
                <button id="abrirModal3" class="solicitar-button">Solicitar Servicio</button>
            </div>
        </section>
    </div>


    <!-- Contenido Modal -->
    <!-- Contenido Modal de Reparación de Hardware -->
<div id="miModal" class="modal-container">
    <div class="modal1-contenido">
        <span id="cerrarModal" class="cerrar">&times;</span>
        <h2>Solicitar Servicio de Reparación de Hardware</h2>
        <p>Completa el siguiente formulario para solicitar el servicio:</p>
        <form>
            <input type="text" placeholder="Nombre">
            <input type="email" placeholder="Correo Electrónico">
            <select name="tipo-servicio">
                <option value="" disabled selected>Selecciona un tipo de Servicio</option>
                <option value="Actualización de hardware">Actualización de hardware</option>
                <option value="Reparación de componentes dañados">Reparación de componentes dañados</option>
                <option value="Limpieza y mantenimiento interno">Limpieza y mantenimiento interno</option>
            </select>
            <textarea placeholder="Cuéntanos Detalladamente tu Problema"></textarea>
            <button type="submit" class="solicitar-button">Solicitar</button>
        </form>
    </div>
</div>

<!-- Contenido Modal de Mantenimiento de Software -->
<div id="miModal2" class="modal-container">
    <div class="modal2-contenido">
        <span id="cerrarModal2" class="cerrar">&times;</span>
        <h2>Solicitar Servicio de Mantenimiento de Software</h2>
        <p>Completa el siguiente formulario para solicitar el servicio:</p>
        <form>
            <input type="text" placeholder="Nombre">
            <input type="email" placeholder="Correo Electrónico">
            <select name="tipo-servicio">
                <option value="" disabled selected>Selecciona un tipo de Servicio</option>
                <option value="Actualización del sistema operativo">Actualización del sistema operativo</option>
                <option value="Optimización de rendimiento">Optimización de rendimiento</option>
                <option value="Formateo de dispositivo">Formateo de dispositivo</option>
            </select>
            <textarea placeholder="Cuéntanos Detalladamente tu Problema"></textarea>
            <button type="submit" class="solicitar-button">Solicitar</button>
        </form>
    </div>
</div>

<!-- Contenido Modal de Soporte Técnico Remoto -->
<div id="miModal3" class="modal-container">
    <div class="modal3-contenido">
        <span id="cerrarModal3" class="cerrar">&times;</span>
        <h2>Solicitar Servicio de Soporte Técnico Remoto</h2>
        <p>Completa el siguiente formulario para solicitar el servicio:</p>
        <form>
            <input type="text" placeholder="Nombre">
            <input type="email" placeholder="Correo Electrónico">
            <select name="tipo-servicio">
                <option value="" disabled selected>Selecciona un tipo de Servicio</option>
                <option value="Configuración de redes y conexiones">Configuración de redes y conexiones</option>
                <option value="Asistencia en la instalación de software">Asistencia en la instalación de software</option>
                <option value="Asistencia en la configuración de dispositivos">Asistencia en la configuración de dispositivos</option>
            </select>
            <textarea placeholder="Cuéntanos Detalladamente tu Problema"></textarea>
            <button type="submit" class="solicitar-button">Solicitar</button>
        </form>
    </div>
</div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
        
        document.getElementById('abrirModal1').addEventListener('click', function() {
            var modal = document.getElementById('miModal');
            modal.style.display = 'block';
            centerModal(modal);
        });

        document.getElementById('abrirModal2').addEventListener('click', function() {
            var modal = document.getElementById('miModal2');
            modal.style.display = 'block';
            centerModal(modal);
        });

        document.getElementById('abrirModal3').addEventListener('click', function() {
            var modal = document.getElementById('miModal3');
            modal.style.display = 'block';
            centerModal(modal);
        });


            document.getElementById('cerrarModal').addEventListener('click', function() {
                document.getElementById('miModal').style.display = 'none';
            });

            document.getElementById('cerrarModal2').addEventListener('click', function() {
                document.getElementById('miModal2').style.display = 'none';
            });

            document.getElementById('cerrarModal3').addEventListener('click', function() {
                document.getElementById('miModal3').style.display = 'none';
            });

            function centerModal(modal) {
                var windowHeight = window.innerHeight;
                var modalHeight = modal.offsetHeight;
                var top = (windowHeight - modalHeight) / 2;
                modal.style.top = top + 'px';
            }
        });
    </script>

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