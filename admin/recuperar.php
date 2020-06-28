<?php
session_start();
include "clases/cargar_clases.php";
$conn = ConnDb::conectar();

if(isset($_POST['email'])){

    $sql = "SELECT * FROM usuarios WHERE correo = :correo";
    $sentencia = $conn->prepare($sql);
    $sentencia->bindParam(':correo',$_POST['email']);
    $sentencia->execute();

    $user = $sentencia->fetch(PDO::FETCH_ASSOC);
    
    if(isset($user['id'])){
        header("Location: password_new.php?id=".$user['id']);
    }else{
        header("Location: password.php");
    }

}elseif(isset($_POST['password1'])){

    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
    $sentencia = $conn->prepare($sql);
    $sentencia->bindParam(':password',$password);
    $sentencia->bindParam(':id',$_POST['id']);
    $sentencia->execute();

    $_SESSION['mensaje'] = "Password modificado con exito, por favor ingrese los datos para acceder al administrador";
	$_SESSION['tipo'] = "success";
    
    header("Location: index.php");

}