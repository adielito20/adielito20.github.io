<?php

define("CLIENT_ID", "AftbqEQeUYQkI5wXnbwfXcxD3dvj0qH9L_KFEblkEpEk0jCMMmBP8gIZ_uyXblBIlVh-2vav6tRFJ3-n");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA","S/");

session_start();

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}

?>