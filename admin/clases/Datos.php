<?php
/**
 * Datos
 */
class Datos
{
	private $conn;
	
	public function __construct()
	{
		$this->conn = ConnDb::conectar();
	}

	public function mostrarDatos()
	{
		$sql = "SELECT * FROM datos 
				WHERE id = '1'";
		$sentencia = $this->conn->prepare($sql);
		$sentencia->execute();
		$restaurant = $sentencia->fetch(PDO::FETCH_ASSOC);

		return $restaurant;
	}

	public function editDatos($nombre, $descripcion, $telefono_local, $whatsapp, $direccion, $pago, $entrega, $envio)
	{
		$sql = "UPDATE datos 
				SET nombre = :nombre,
				descripcion = :descripcion,
				telefono_local = :telefono_local,
				whatsapp = :whatsapp,
				direccion = :direccion,
				pago = :pago,
				entrega = :entrega,
				envio = :envio
				WHERE id = '1'";
		$sentencia = $this->conn->prepare($sql);
		$sentencia->bindParam(':nombre',$nombre);
		$sentencia->bindParam(':descripcion',$descripcion);
		$sentencia->bindParam(':telefono_local',$telefono_local);
		$sentencia->bindParam(':whatsapp',$whatsapp);
		$sentencia->bindParam(':direccion',$direccion);
		$sentencia->bindParam(':pago',$pago);
		$sentencia->bindParam(':entrega',$entrega);
		$sentencia->bindParam(':envio',$envio);
		
		if($sentencia->execute()){
			$_SESSION['mensaje'] = "Datos modificados con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

}