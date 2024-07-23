<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos =isset($_SESSION['carrito']['productos'])?$_SESSION['carrito']['productos']:null ;

//Extrear los productos que tenemos en la sesion
print_r($_SESSION);

$lista_carrita = array();

if ($productos != null) {
    foreach ($productos as $clave => $cantidad) {
        // Obtener productos
        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad, ruta_imagen FROM productos WHERE id = ?");
        $sql->execute([$clave]);
        $producto = $sql->fetch(PDO::FETCH_ASSOC); // Usar fetch en lugar de fetchAll
        $lista_carrito[] = $producto;
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
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
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
                                <td><?php echo MONEDA . number_format($_precio_desc, 2, '.', ','); ?></td>
                                <td>
                                <input type="number" min="1" max="10" step="1" value="<?php echo $_cantidad; ?>" size="5" id="cantidad_<?php echo $_id; ?>" onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                                </td>
                                <td>
                                    <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?></div>
                                </td>

                            <!-- Boton que activa el modal -->


                                <td><a class="btn btn-warning btn-sm" data-bs-id="<?php echo 
                                $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                                </td>
                            </tr>
                    <?php } ?>
                       <tr>
                        <td colspan="3"></td>
                        <td colspan="2">
                            <p class="h3" id="total"><?php echo MONEDA.number_format($total,2,'.',',');?></p>
                        </td>

                       </tr> 
                </tbody>
                <?php }?>
            </table>
        </div>
        <?php if ($lista_carrito !== null) { ?>

       <div class="row">
        <div class="col-md-5 offset-md-7 d-grid grap-2">
            <a href="pago.php" class="btn btn-primary btn-lg">Realizar Pago</a>
        
        </div> 
       </div> 
       <?php } ?>
    </div>
</main>




<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminaModalLabel">Eliminar Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar este producto de la lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina" type="button" class="btn btn-danger" onclick=eliminar()>Eliminar</button>
      </div>
    </div>
  </div>
</div>



<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

    
<script>


let elminaModal = document.getElementById('eliminaModal')
eliminaModal.addEventListener('show.bs.modal', function(event){
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value = id
})




    function actualizaCantidad(cantidad, id) {
        let url = 'clases/actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'agregar');
        formData.append('id', id);
        formData.append('cantidad', cantidad);

        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    //subtotal
                    let divsubtotal = document.getElementById('subtotal_' + id);
                    divsubtotal.innerHTML = data.sub;
                    
                    //total
                    let list = document.getElementsByName('subtotal[]');
                    let total = 0.00

                    for(let i = 0; i<list.length; i++){
                        total += parseFloat(list[i].innerHTML.replace(/[S/,]/g, ''));
                    }

                    total = new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2
                    }).format(total)
                    
                    document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' +total

                } else {
                    // Manejar fallo
                    console.error('Error al agregar el producto al carrito');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }


    function eliminar() {

        let botonElimina = document.getElementById('btn-elimina')
        let id = botonElimina.value

        let url = 'clases/actualizar_carrito.php';
        let formData = new FormData();
        formData.append('action', 'eliminar');
        formData.append('id', id);


        fetch(url, {
            method: 'POST',
            body: formData,
            mode: 'cors'
        }).then(response => response.json())
            .then(data => {
                if (data.ok) {
                    location.reload()

                } 
            })
    }



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
        <p>Copyright &copy;2023; Derechos Reservados: Taller de Programación Web</p>
    </div>
</footer>

    
</body>

</html>

