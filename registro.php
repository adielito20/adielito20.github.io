<?php

require 'config/config.php';
require 'config/database.php';

// Verificar si se ha enviado el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una instancia de la clase Database
    $db = new Database();
    $con = $db->conectar();

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia']; // La contraseña se guarda tal cual

    // Insertar datos en la base de datos
    $sql = $con->prepare("INSERT INTO usuarios (nombre, email, contrasenia) VALUES (?, ?, ?)");
    $resultado = $sql->execute([$nombre, $correo, $contrasenia]);

    if ($resultado) {
        // Registro exitoso, puedes redirigir al usuario si lo deseas
        // header('Location: index.php');
        // exit;
    } else {
        $warning_message = 'Error al guardar el usuario';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css" type="text/css">

    <title>Registrar</title>
</head>

<body>
    <div class="contorno">
        <div class="caja-formulario">
            <img class="logo" src="imagenes/logo.jpg" ><BR></BR>
            <h1 class="titulo-reg">REGISTRATE AQUÍ</h1>

            <form action="" method="POST" id="formr">
                <div class="ingresar-datos">
                    <span class="icono"><ion-icon name="person"></ion-icon></span>
                    <input type="text" id="nombre" name="nombre" required>
                    <label>Nombre</label>
                </div>
                <div class="ingresar-datos">
                    <span class="icono"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" id="correo" name="correo" required>
                    <label>Email</label>
                </div>
                <div class="ingresar-datos">
                    <span class="icono"><ion-icon name="lock-closed"></ion-icon></ion-icon></span>
                    <input type="password" id="contrasenia" name="contrasenia" required>
                    <label>Password</label>
                </div>
                <div class="ingresar-datos">
                    <span class="icono"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" id="r-contrasenia" required>
                    <label>Confirmar Password</label></BR>
                </div>
                <div>
                    </BR>
                    <button type="submit" class="btn-registro" id="btn-registro">Registrarme</button>
                    <p class="warning" id="warning"><?php echo isset($warning_message) ? $warning_message : ''; ?></p>
                </div>
                <div class="iniciar-sesion">
                    <p>Ya tengo una cuenta <a href="inicio_sesion.php">Iniciar sesión</a></p>
                </div>
            </form>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </div>
    </div>
</body>

</html>
