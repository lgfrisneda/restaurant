<?php
$user = $usuario->mostrarUsuario();
?>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Administrador | Rest</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item"  data-toggle="modal" data-target="#dataUser">Mi perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onClick="salir()">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- Modal -->
        <div class="modal fade" id="dataUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Mi perfil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="resp_usuario.php">
                            <div class="form-group">
                                <label for="email">Correo:</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['correo'];?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Dejar vacio para mantener el password">
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
        <script type="text/javascript">
            function salir(){
                if(confirm("Seguro que desea cerrar sesion?")){
                    window.location.href = "salir.php";
                }
            }
        </script>