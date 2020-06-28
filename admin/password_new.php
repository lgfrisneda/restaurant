<?php
if(!$_GET){
    header("Location: index.php");
}
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
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Ingresar nuevo password</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Ingrese su nuevo password.</div>
                                        <form id="formCheckPassword" method="POST" action="recuperar.php">
                                            <input class="form-control py-4" name="id" id="id" type="hidden" value="<?php echo $_GET['id'];?>"/>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password1">Password</label>
                                                <input class="form-control py-4" name="password1" id="password1" type="password" placeholder="Nuevo password" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password2">Confirmar Password</label>
                                                <input class="form-control py-4" name="password2" id="password2" type="password" placeholder="Ingresa de nuevo el password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary btn btn-block" type="submit" value="Recuperar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php include "footer.php";?>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="dist/js/scripts.js"></script>
        <script>
            $("#formCheckPassword").validate({
                rules: {
                    email: { 
                        required: true,
                    } , 
                    password1: { 
                        required: true,
                        minlength: 6,
                        maxlength: 10,
                    } , 
                    password2: { 
                        equalTo: "#password1",
                        minlength: 6,
                        maxlength: 10
                    }
                },
                messages:{
                    email: { 
                        required:"Email requerido"
                    },
                    password1: { 
                        required:"Password Requerido",
                        minlength: "Minimo 6 caracteres",
                        maxlength: "Maximo 10 caracteres"
                    },
                    password2: { 
                        equalTo: "El password debe ser igual al anterior",
                        minlength: "Minimo 6 caracteres",
                        maxlength: "Maximo 10 caracteres"
                    }
                }
            });
        </script>
    </body>
</html>
