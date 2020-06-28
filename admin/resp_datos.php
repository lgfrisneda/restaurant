<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

if(isset($_POST['nombre'])){
    $datos->editDatos($_POST['nombre'], $_POST['descripcion'], $_POST['telefono_local'], $_POST['whatsapp'], $_POST['direccion'], $_POST['pago'], $_POST['entrega'], $_POST['envio'], $_POST['envio_monto']);
}