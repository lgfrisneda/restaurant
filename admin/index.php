<?php
session_start();
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 my-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <?php 
                                    if(isset($_SESSION['mensaje'])){ 
                                    ?>
                                    <div class="alert alert-<?php echo $_SESSION['tipo'];?>" align="center" >
                                        <strong> <?php echo $_SESSION['mensaje'];?> </strong>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                    <div class="card-body">
                                        <form method="POST" action="acceso.php">
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input class="form-control py-4" name="email" id="email" type="email" placeholder="Ingresa tu email" required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Password</label>
                                                <input class="form-control py-4" name="password" id="password" type="password" placeholder="Ingresa tu password" required/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.php">Olvido su Password?</a>
                                                <input class="btn btn-primary" type="submit" value="Ingresar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php 
            session_destroy();
            include "footer.php";
            ?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dist/js/scripts.js"></script>
    </body>
</html>
