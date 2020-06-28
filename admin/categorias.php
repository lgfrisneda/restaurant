<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();
$cats = $categorias->listarCategorias();
$item = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Administrador de restaurant</title>
        <link href="dist/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include "includes/superior.php";?>
        <div id="layoutSidenav">
            <?php include "includes/lateral.php";?>
            <div id="layoutSidenav_content">
                <main>
                <?php 
                if(isset($_SESSION['mensaje'])){ 
                ?>
                <div class="alert alert-<?php echo $_SESSION['tipo'];?>" align="center" >
                    <strong> <?php echo $_SESSION['mensaje'];?> </strong>
                </div>
                <?php 
                    unset($_SESSION['mensaje']);
                    unset($_SESSION['tipo']);
                }
                ?>
                    <div class="container-fluid">
                        <div class="d-flex">
                            <h1 class="mt-4">Categorías-Productos</h1>
                            <div class="mt-4 ml-auto">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategoria">Nueva Categoría</button>
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#addProducto">Nuevo Producto</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Nueva Categoría</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="resp_categorias.php">
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de categoría">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="addProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Nuevo Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="resp_productos.php">
                                            <div class="form-group">
                                                <label for="id_categoria">Categoría:</label>
                                                <select class="form-control" name="id_categoria" id="id_categoria">
                                                    <option>Seleccione</option>
                                                    <?php foreach($cats as $categoria){?>
                                                        <option value="<?php echo $categoria['id'];?>"><?php echo $categoria['nombre'];?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de producto">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Descripcion:</label>
                                                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="precio">Precio producto (opcional):</label>
                                                <input type="text" class="form-control" name="precio" id="precio" placeholder="Precio de producto">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div id="accordion">
                                <?php foreach($cats as $categoria){?>
                                <div class="card">
                                    <div class="card-header d-flex" id="heading<?php echo $categoria['id'];?>">
                                        <h5 class="mb-0 d-inline-block">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $categoria['id'];?>" aria-expanded="false" aria-controls="collapseTwo">
                                            <?php echo  $categoria['nombre'];?>
                                            </button>
                                        </h5>
                                        <button class="btn btn-primary ml-auto" type="button" data-toggle="modal" data-target="#editCategoria<?php echo  $categoria['id'];?>">Editar</button>
                                        <a onClick="validarborrar(<?php echo  $categoria['id'];?>,'<?php echo  $categoria['nombre'];?>')"><button class="btn btn-danger ml-1">Borrar</button></a>
                                    </div>
                                    <div id="collapse<?php echo $categoria['id'];?>" class="collapse" aria-labelledby="heading<?php echo $categoria['id'];?>" data-parent="#accordion">
                                        <div class="card-body">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <?php
                                                    $prods = $productos->listarProductos($categoria['id']);
                                                    foreach($prods as $producto){
                                                    ?>
                                                    <tr class="d-flex">
                                                        <td class="col-sm-3"><?php echo $producto['nombre'];?></td>
                                                        <td class="col-sm-6"><?php echo $producto['descripcion'];?></td>
                                                        <td class="col-sm-1"><?php echo $producto['precio'];?></td>
                                                        <td class="col-sm-2">
                                                            <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#editProducto<?php echo  $producto['id'];?>"><i class="fas fa-pen"></i></button>
                                                            <a onClick="validarborrarPro(<?php echo  $producto['id'];?>,'<?php echo  $producto['nombre'];?>')"><button class="btn btn-outline-danger"><i class="fas fa-trash"></i></button></a>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editProducto<?php echo  $producto['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="resp_productos.php">
                                                                    <input type="hidden" class="form-control" name="id" id="id" value="<?php echo  $producto['id'];?>">
                                                                        <div class="form-group">
                                                                            <label for="id_categoria">Categoría:</label>
                                                                            <select class="form-control" name="id_categoria" id="id_categoria">
                                                                                <option>Seleccione</option>
                                                                                <?php foreach($cats as $categoria){?>
                                                                                    <option value="<?php echo $categoria['id'];?>" <?php echo ($producto['id_categoria'] == $categoria['id'])? "Selected":"";?>><?php echo $categoria['nombre'];?></option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nombre">Nombre:</label>
                                                                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $producto['nombre'];?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="descripcion">Descripcion:</label>
                                                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"><?php echo $producto['descripcion'];?></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="precio">Precio producto (opcional):</label>
                                                                            <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $producto['precio'];?>">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Modificar</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="editCategoria<?php echo  $categoria['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Categoría</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="resp_categorias.php">
                                            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo  $categoria['id'];?>">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre:</label>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo  $categoria['nombre'];?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include "footer.php";?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dist/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="dist/assets/demo/chart-area-demo.js"></script>
        <script src="dist/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="dist/assets/demo/datatables-demo.js"></script>
        <script>
            function validarborrar(id, categoria){
                if(confirm("¿Estas seguro que quieres eliminar a "+categoria+"?")){
                    window.location.href="resp_categorias.php?id="+id;
                }
            }
            function validarborrarPro(id, producto){
                if(confirm("¿Estas seguro que quieres eliminar a "+producto+"?")){
                    window.location.href="resp_productos.php?id="+id;
                }
            }
        </script>
    </body>
</html>