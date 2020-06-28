<?php
	include "ConnDb.php";
	include "Usuario.php";
	include "Datos.php";
	include "Productos.php";
	include "Categorias.php";

	$usuario = new Usuario;
	$datos = new Datos;
	$categorias = new Categorias;
	$productos = new Productos;

	//$usuarios->validaSession();