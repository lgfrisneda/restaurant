<?php

class ConnDb
{
	static public function conectar(){
		$servidor = "mysql:dbname=restadm;host=127.0.0.1";
		$usuario = "root";
		$clave = "";

		try {

			$pdo = new PDO($servidor, $usuario, $clave, array(PDO::MYSQL_ATTR_INIT_COMMAND=>("SET NAMES utf8")));

			//echo "conectado";

			return $pdo;
			
		}catch(PDOException $e){

			echo "Error al conectar ".$e;

			exit;

		}
	}
}