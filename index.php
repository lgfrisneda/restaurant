<?php
include "admin/clases/cargar_clases.php";
$data = $datos->mostrarDatos();
$cats = $categorias->listarCategorias();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title><?php echo $data['nombre'] ?></title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/offcanvas/">

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      background-image: url('https://www.laespanolaaceites.com/wp-content/uploads/2019/06/pizza-con-chorizo-jamon-y-queso-1080x671.jpg');
      filter: grayscale(45%);

      font-size: 1.125rem;
      background-size: cover;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .sombra {
      text-shadow: 4px 2px 7px black;
      font-weight: bold;
      font-size: 4.5rem;
      line-height: 1.2;
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="assets/dist/css/offcanvas.css" rel="stylesheet">
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <a class="navbar-brand mr-auto mr-lg-0" href="#"><?php echo $data['nombre'] ?></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Menu <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="navbar navbar-expand-md navbar-light fixed-bottom bg-light">
    <a class="btn btn-success" style="width:100%;" href="https://api.whatsapp.com/send?phone=<?php echo $data['whatsapp'] ?>" target="_blank"><i class="fa fa-whatsapp"></i> Hace tu pedido</a>
  </nav>

  <div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
      <a class="nav-link active">Categorías</a>
      <?php
      foreach ($cats as $categoria) {
      ?>
        <a class="nav-link" href="#<?php echo strtolower(trim($categoria['nombre'])) ?>"><?php echo $categoria['nombre'] ?></a>
      <?php } ?>
    </nav>
  </div>

  <main role="main">
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="bd-placeholder-img">
      <div class="container">
        <h1 class="display-3 text-white sombra"><?php echo $data['nombre'] ?></h1>
        <p class="text-white"><?php echo $data['descripcion'] ?></p>
        <p class="text-white">Forma de entrega: <?php echo $data['entrega'] ?></p>
        <p class="text-white">Forma de Pagos: <?php echo $data['pago'] ?></p>
        <p class="text-white">Costo envio:
          <?php
            echo $data['envio'];
            echo ($data['envio'] == "Precio fijo") ? " - " . $data['monto'] : "";
          ?></p>
        <br>
      </div>
    </div>
    <div class="container">
      <?php
      foreach ($cats as $categoria) {
      ?>
        <div class="my-3 p-3 bg-white rounded shadow-sm">
          <h6 class="border-bottom border-gray pb-2 mb-0" id="<?php echo strtolower(trim($categoria['nombre'])) ?>"><?php echo $categoria['nombre'] ?></h6>
          <?php
          $prods = $productos->listarProductos($categoria['id']);
          foreach ($prods as $producto) {
          ?>
            <div class="media text-muted pt-3">
              <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <strong class="d-block text-gray-dark"><?php echo $producto['nombre'] ?></strong>
                <?php echo $producto['descripcion'] ?>
              </p>
              <div class="1h-100" style="margin-left: auto;">
                <a class="btn btn-danger btn-sm text-white" href="https://api.whatsapp.com/send?phone=<?php echo $data['whatsapp'] ?>&text=Hola!%20Este%20es%20mi%20pedido:%20<?php echo $producto['nombre'] ?>" target="_blank">+</a>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>
  </main>
  <br /><br /><br />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="../assets/dist/js/bootstrap.bundle.js"></script>
  <script src="assets/dist/js/offcanvas.js"></script>
</body>

</html>