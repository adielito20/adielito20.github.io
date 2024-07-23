<?php

require '../config/config.php';
require '../config/database.php';
$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

echo '<pre>';
print_r($datos);

if (is_array($datos)) {
    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));

    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];

    $sql = $con->prepare("INSERT INTO compra (id_transaccion, fecha, status, email, id_cliente, total) VALUES (?,?,?,?,?,?)");
    $sql->execute([$id_transaccion, $fecha_nueva, $status, $email, $id_cliente, $total]);
    $id_compra = $con->lastInsertId();

    if ($id_compra > 0) {
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        if ($productos != null) {
            foreach ($productos as $clave => $cantidad) {
                // Obtener productos
                $sql_prod = $con->prepare("SELECT id, nombre, precio, descuento FROM productos WHERE id = ? AND activo=1");
                $sql_prod->execute([$clave]);
                $row_prod = $sql_prod->fetch(PDO::FETCH_ASSOC);

                $_precio = $row_prod['precio'];
                $_descuento = $row_prod['descuento'];
                $_cantidad = $cantidad;
                $_precio_desc = $_precio - (($_precio * $_descuento) / 100);

                $sql_insert = $con->prepare("INSERT INTO detalle_compra (id_compra, id_producto, nombre, precio, cantidad) VALUES (?,?,?,?,?)");
                $sql_insert->execute([$id_compra, $clave, $row_prod['nombre'], $_precio_desc, $cantidad]);
            }
        }
    }
}
?>


?>
