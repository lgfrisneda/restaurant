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

    public function addProducto($id_categoria, $nombre, $descripcion, $precio, $imagen)
    {
        if(!empty($imagen)){		
            $img_campo = ", imagen";
            $img_value = ", :imagen";
		}else{
			$img_campo = "";
            $img_value = "";
		}

        $sql = "INSERT INTO productos (id_categoria,nombre,descripcion,precio".$img_campo.") VALUES (:id_categoria,:nombre,:descripcion,:precio".$img_value.")";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id_categoria',$id_categoria);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':descripcion',$descripcion);
        $sentencia->bindParam(':precio',$precio);
        if(!empty($imagen)){
            $sentencia->bindParam(':imagen',$imagen);
        }
        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Producto agregado con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function editProducto($id_categoria, $nombre, $descripcion, $precio, $imagen, $id)
    {
        if(!empty($imagen)){
			$sentencia = $this->conn->prepare("SELECT imagen FROM productos 
			WHERE id = :id");

            $sentencia->bindParam(':id',$id);
			$sentencia->execute();

			$imgOld = $sentencia->fetch(PDO::FETCH_LAZY);

			if(!empty($imgOld['imagen'])){
				if(file_exists("../imagenes/".$imgOld['imagen'])){
					unlink("../imagenes/".$imgOld['imagen']);
				}
			}
		
			$img_sql = ", imagen = :imagen";
		}else{
			$img_sql = "";
        }
        
        $sql = "UPDATE productos 
                SET id_categoria = :id_categoria,
                nombre = :nombre,
                descripcion = :descripcion,
                precio = :precio".
                $img_sql."
                WHERE id = :id";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->bindParam(':id_categoria',$id_categoria);
        $sentencia->bindParam(':nombre',$nombre);
        $sentencia->bindParam(':descripcion',$descripcion);
        $sentencia->bindParam(':precio',$precio);
        if(!empty($imagen)){
			$sentencia->bindParam(':imagen',$imagen);
		}
        $sentencia->bindParam(':id',$id);

        if($sentencia->execute()){
			$_SESSION['mensaje'] = "Producto modificadio con éxito";
			$_SESSION['tipo'] = "success";
		}else{
			$_SESSION['mensaje'] = "No se pudo realizar la acción, intente nuevamente";
			$_SESSION['tipo'] = "warning";
		}
        
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    public function deleteProducto($id)
    {
        $sentencia = $this->conn->prepare("SELECT imagen FROM productos 
			WHERE id = :id");

        $sentencia->bindParam(':id',$id);
		$sentencia->execute();

		$imgOld = $sentencia->fetch(PDO::FETCH_LAZY);

		if(!empty($imgOld['imagen'])){
			if(file_exists("../imagenes/".$imgOld['imagen'])){
				unlink("../imagenes/".$imgOld['imagen']);
			}
        }
            
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