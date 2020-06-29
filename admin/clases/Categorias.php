<?php
class Categorias
{
    private $conn;
	
	public function __construct()
	{
		$this->conn = ConnDb::conectar();
    }
    
    public function listarCategorias()
    {
        $sql = "SELECT * FROM categorias ORDER BY id ASC";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();

        $categorias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        return $categorias;
    }

    public function addCategoria($nombre)
    {
        $sql = "INSERT INTO categorias (nombre) VALUES (:nombre)";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':nombre',$nombre);
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Categoría agregada con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function editCategoria($nombre, $id)
    {
        $sql = "UPDATE categorias 
                SET nombre = :nombre
                WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':id',$id);
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Categoría modificada con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function deleteCategoria($id)
    {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id',$id);
        $sentencia->execute();

        $sentencia = $this->conn->prepare("SELECT imagen FROM productos 
			WHERE id_categoria = :id_categoria");

        $sentencia->bindParam(':id_categoria',$id);
		$sentencia->execute();

        $imgOld = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($imgOld as $img){
            if(!empty($img['imagen'])){
                if(file_exists("../imagenes/".$img['imagen'])){
                    unlink("../imagenes/".$img['imagen']);
                }
            }
        }

        $sql = "DELETE FROM productos WHERE id_categoria = :id_categoria";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id_categoria',$id);
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Categoría eliminada";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}

        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
}