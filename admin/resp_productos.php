<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();

$fecha = new DateTime();
$nombreArchivo = ($_FILES['imagen']['name'] != '')? $fecha->getTimestamp()."_".$_FILES['imagen']['name']: '';
$tmpImagen = $_FILES['imagen']['tmp_name'];

if($tmpImagen != ""){
    move_uploaded_file($tmpImagen, "../imagenes/".$nombreArchivo);
}

if(isset($_POST['id'])){
    $productos->editProducto($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $nombreArchivo, $_POST['id']);
}elseif(isset($_POST['id_categoria']) && isset($_POST['nombre'])){
    $productos->addProducto($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $nombreArchivo);
}elseif(isset($_GET['id'])){
    $productos->deleteProducto($_GET['id']);
}