<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

if(isset($_POST['id_categoria']) && isset($_POST['nombre']) && isset($_POST['descripcion'])){
    $productos->addProducto($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion']);
}elseif(isset($_GET['id'])){
    $productos->deleteProducto($_GET['id']);
}