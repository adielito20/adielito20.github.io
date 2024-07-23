
<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if($id == '' || $token ==''){
    echo 'Error al procesar la petición';
    exit;

}   else{

        $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

        if($token == $token_tmp){

        // Obtener productos de cualquier Categoria
        $sqlDetalle = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sqlDetalle->execute([$id]);
        if($sqlDetalle->fetchColumn()>0){

            
            $sqlDetalle = $con->prepare("SELECT nombre, descripcion, precio, descuento, categoria, ruta_imagen FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sqlDetalle->execute([$id]);
            $row =$sqlDetalle->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $categoria = $row['categoria'];
            $ruta_imagen = $row['ruta_imagen'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            
        }

        }else{
            echo 'Error al procesar la peticion';
            exit;
        }
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

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="css/detalles.css">

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
            <div class="row bg-dark border-0">
    <div class="col-md-7 py-4">
        <div class="logo">
            <img src="imagenes/logotipo.png" alt="logo compuplanet">
        </div>
    </div>
    <div class="col-sm-4 py-4 text-end">
        <p>
            <?php echo $boton_iniciar_sesion; ?> |||| 
            <?php echo $boton_registro; ?>
        </p>
    </div>
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

        <br><br>
        

<!--Contenido-->
<main>
    <div class="container">
        <div class="row">
        <div class="col-md-6 order-md-1">
                <img class="imagen" src="imagenes/Productos/<?php echo $row['categoria'] . '/' . $row['ruta_imagen']; ?>">
            </div>

            <div class="col-md-5 order-md-1 informacion"> <br><br><br><br><br><br><br>

                <div class="informacion">
                    <h2><?php echo $nombre;?></h2>

                    <?php if($descuento > 0) { ?>
                        <p><del><?php echo MONEDA . number_format($precio, 2, '.', ',');?></del></p>
                        <h2>
                            <?php echo MONEDA . number_format($precio_desc, 2, '.', ',');?>
                            <small class="text-success"><?php echo $descuento;?>% descuento</small>
                        </h2>
                    <?php } else { ?>
                        <h2><?php echo MONEDA . number_format($precio, 2, '.', ',');?></h2>
                    <?php } ?>
                </div>

                <p class="lead">
                    <?php echo $descripcion;?>
                </p><br><br>
                <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="comprar">Comprar Ahora</button>
                    <button class="agregar" onclick="addProducto(<?php echo $id;?>,'<?php echo $token_tmp;?>')">Agregar al Carrito</button>
                </div>
            </div>

        </div>
    </div>   
</main>  

<script>
    function addProducto(id, token) {
        let url = 'clases/carrito.php';
        let formData = new FormData();
        formData.append('id', id);
        formData.append('token', token);

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    // Manejar éxito, por ejemplo, actualizar el contador del carrito
                    let elemento = document.getElementById('num_cart');
                    elemento.innerHTML = data.numero;
                } else {
                    // Manejar fallo
                    console.error('Error al agregar el producto al carrito');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>




<br><br><br>



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

