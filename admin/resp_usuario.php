<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

if(isset($_POST['email'])){
    $usuario->editUsuario($_SESSION['usuarios']['id'], $_POST['email'], $_POST['password']);
}