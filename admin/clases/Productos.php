<?php
class Productos
{
    private $conn;
	
	public function __construct()
	{
		$this->conn = ConnDb::conectar();
    }
    
    public function listarProductos($id_categoria)
    {
        $sql = "SELECT * FROM productos 
                WHERE id_categoria = :id_categoria
                ORDER BY id ASC";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id_categoria',$id_categoria);
        $sentencia->execute();

        $productos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $productos;
    }

    public function addProducto($id_categoria, $nombre, $descripcion)
    {
        $sql = "INSERT INTO productos (id_categoria,nombre,descripcion) VALUES (:id_categoria,:nombre,:descripcion)";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id_categoria',$id_categoria);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':descripcion',$descripcion);
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Producto agregado con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function deleteProducto($id)
    {
        $sql = "DELETE FROM productos WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id',$id);
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Producto eliminado";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}