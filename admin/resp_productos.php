<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

if(isset($_POST['id'])){
    $productos->editProducto($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['id']);
}elseif(isset($_POST['id_categoria']) && isset($_POST['nombre'])){
    $productos->addProducto($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio']);
}elseif(isset($_GET['id'])){
    $productos->deleteProducto($_GET['id']);
}