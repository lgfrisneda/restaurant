<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

if(isset($_POST['id']) && isset($_POST['nombre'])){
    $categorias->editCategoria($_POST['nombre'], $_POST['id']);
}elseif(isset($_POST['nombre'])){
    $categorias->addCategoria($_POST['nombre']);
}elseif(isset($_GET['id'])){
    $categorias->deleteCategoria($_GET['id']);
}