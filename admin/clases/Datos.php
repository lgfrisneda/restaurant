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

	public function editDatos($nombre, $descripcion, $telefono_local, $whatsapp, $direccion, $pago, $entrega, $envio, $monto, $imagen)
	{
		if(!empty($monto)){
			$monto_sql = ", monto = :monto";
		}else{
			$monto_sql = "";
		}

		if(!empty($imagen)){
			$sentencia = $this->conn->prepare("SELECT imagen FROM datos 
			WHERE id = '1'");

			$sentencia->execute();

			$imgOld = $sentencia->fetch(PDO::FETCH_LAZY);

			if(!empty($imgOld['imagen'])){
				if(file_exists("../imagenes/logo/".$imgOld['imagen'])){
					unlink("../imagenes/logo/".$imgOld['imagen']);
				}
			}
		
			$img_sql = ", imagen = :imagen";
		}else{
			$img_sql = "";
		}

		$sql = "UPDATE datos 
				SET nombre = :nombre,
				descripcion = :descripcion,
				telefono_local = :telefono_local,
				whatsapp = :whatsapp,
				direccion = :direccion,
				pago = :pago,
				entrega = :entrega,
				envio = :envio".
				$monto_sql.
				$img_sql."
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
		if(!empty($monto)){
			$sentencia->bindParam(':monto',$monto);
		}
		if(!empty($imagen)){
			$sentencia->bindParam(':imagen',$imagen);
		}
		
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