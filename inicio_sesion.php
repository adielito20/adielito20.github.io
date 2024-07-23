<?php

require 'config/config.php';
require 'config/database.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una instancia de la clase Database
    $db = new Database();
    $con = $db->conectar();

    // Obtener datos del formulario
    $email = $_POST['usuario'];
    $contrasenia_ingresada = $_POST['contrasenia'];

    // Buscar el usuario por correo
    $sql = $con->prepare("SELECT * FROM usuarios WHERE email = ?");
    $sql->execute([$email]);
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    if ($usuario && $contrasenia_ingresada === $usuario['contrasenia']) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_email'] = $usuario['email'];
        // Puedes almacenar otros datos según sea necesario
        header('Location: index.php'); // Redirige a la página de inicio del usuario
        exit;
    } else {
        $error_message = 'Credenciales incorrectas';
    }
}

?>

<!-- Resto del código HTML sigue igual -->


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicio_sesion.css" type="text/css">
    <title>Iniciar Sesión SI</title>
</head>

<body>
    <div class="caja-formulario">
        <img class="logo" src="imagenes/logo.jpg" alt="ingreso-sesion">
        <h1 class="titulo-i-sesion">INICIAR SESIÓN</h1>
        <form action="" method="POST">
            <div class="ingresar-datos">
                <span class="icono"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="usuario" id="usuario" required>
                <label>Email</label>
            </div>
            <div class="ingresar-datos">
                <span class="icono"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="contrasenia" id="contrasenia" required>
                <label>Password</label>
            </div>
            <div class="mensaje-error">
                <?php if (isset($error_message)) : ?>
                    <?php echo $error_message; ?>
                <?php endif; ?>
            </div>
            <div class="olvide-password">
                <a href="#">¿Olvidaste tu contraseña?</a>
            </div>
            <div>
                <button type="submit" class="btn-ingresar" id="btn-iniciar">Ingresar</button>
            </div>
            <div class="no-registrado">
                <p>¿No eres miembro?<a href="registro.php"> Regístrate</a></p>
            </div>
        </form>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
