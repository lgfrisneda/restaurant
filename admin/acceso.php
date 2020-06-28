<?php
session_start();
include "clases/cargar_clases.php";

$user = $usuario->acceso($_POST['email'], $_POST['password']);