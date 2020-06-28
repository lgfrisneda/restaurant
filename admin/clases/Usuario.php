<?php
/**
 * Usuario
 */
class Usuario
{
	private $conn;
	
	public function __construct()
	{
		$this->conn = ConnDb::conectar();
	}

	public function acceso($correo, $pass)
	{
		$sql = "SELECT * FROM usuarios WHERE correo = :correo";
		$sentencia = $this->conn->prepare($sql);
		$sentencia->bindParam(':correo',$correo);
		$sentencia->execute();

		$user = $sentencia->fetch(PDO::FETCH_ASSOC);

		if(password_verify($pass, $user['password'])){
			$_SESSION['usuarios'] = $user;
			if(isset($_SESSION['usuarios'])){
				$_SESSION['mensaje'] = "Bienvenido al administrador de restaurant";
				$_SESSION['tipo'] = "success";

				header('Location:home.php');
			}
		}else{
			$_SESSION['mensaje'] = "Verifique los datos e intente nuevamente";
			$_SESSION['tipo'] = "warning";
			header('Location:index.php');
		}

	}

	public function validaSession()
	{
		if(!isset($_SESSION['usuarios']['id'])){
			header('Location: index.php');
		}
	}

	public function mostrarUsuario()
	{
		$sql = "SELECT * FROM usuarios WHERE id = :id";
		$sentencia = $this->conn->prepare($sql);
		$sentencia->bindParam(':id',$_SESSION['usuarios']['id']);
		$sentencia->execute();

		$user = $sentencia->fetch(PDO::FETCH_ASSOC);

		return $user;
	}

	public function editUsuario($id, $correo, $pass)
	{
		if(!empty($pass)){
			$password = password_hash($pass, PASSWORD_DEFAULT);
			$pass_sql = ", password = :password";
		}else{
			$pass_sql = "";
		}
		
		$sql = "UPDATE usuarios 
				SET correo = :correo".
				$pass_sql."
				WHERE id = :id";
		$sentencia = $this->conn->prepare($sql);
		$sentencia->bindParam(':correo',$correo);
		if(!empty($pass)){
			$sentencia->bindParam(':password',$password);
		}
		$sentencia->bindParam(':id',$id);
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