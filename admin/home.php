<?php
session_start();
include "clases/cargar_clases.php";
$validar = $usuario->validaSession();
$data = $datos->mostrarDatos();
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
                            <h1 class="mt-4">Datos del restaurant</h1>
                        </div>
                        <div class="card mb-4">
                            <div class="card">
                                <div class="card-header">
                                    Datos de restaurant
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <table class="table table">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Nombre:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['nombre'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Descripción:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['descripcion'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Dirección:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['direccion'];?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <table class="table table">
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Telef. Local:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['telefono_local'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Whatsapp:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['whatsapp'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Modo de pago:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['pago'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Modo de entrega:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['entrega'];?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0">Modo de envio:</h5>
                                                    </td>
                                                    <td>
                                                        <?php echo $data['envio'];?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#dataRestaurant">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="dataRestaurant" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Datos de restaurant</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="resp_datos.php">
                                        <div class="form-group">
                                            <label for="nombre">Nombre:</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $data['nombre'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción</label>
                                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"><?php echo $data['descripcion'];?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <textarea class="form-control" name="direccion" id="direccion" rows="3"><?php echo $data['direccion'];?></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono_local">Telef. Local:</label>
                                                    <input type="text" class="form-control" name="telefono_local" id="telefono_local" value="<?php echo $data['telefono_local'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="whatsapp">Whatsapp:</label>
                                                    <input type="number" class="form-control" name="whatsapp" id="whatsapp" value="<?php echo $data['whatsapp'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pago">Modo de pago</label>
                                                    <select class="form-control" name="pago" id="pago">
                                                        <option value="<?php echo $data['pago'];?>"><?php echo $data['pago'];?></option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                        <option value="Ambos">Ambos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="entrega">Modo de entrega</label>
                                                    <select class="form-control" name="entrega" id="entrega">
                                                        <option value="<?php echo $data['entrega'];?>"><?php echo $data['entrega'];?></option>
                                                        <option value="Delivery">Delivery</option>
                                                        <option value="Take away">Take away</option>
                                                        <option value="Ambos">Ambos</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="envio">Costo de envío</label>
                                                    <select class="form-control" name="envio" id="envio">
                                                        <option value="<?php echo $data['envio'];?>"><?php echo $data['envio'];?></option>
                                                        <option value="Precio fijo">Precio fijo</option>
                                                        <option value="Indicar importe">Indicar importe</option>
                                                        <option value="Variable">Variable</option>
                                                        <option value="Gratis">Gratis</option>
                                                    </select>
                                                </div>
                                            </div>
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
    </body>
</html>
