<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/allPages.css">
  <link rel="icon" type="image/png" href="uploads/logo-page.png">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Pitzeria girona</title>
</head>

<body>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
      <a href="paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="uploads/logo-page.png" alt="" class="icoLogo">
        <h1>Pitzeria Girona</h1>
      </a>

      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="user/configuracionCuenta/vista/ajustesCuenta.php" class="nav-link text-reset">
            <?php
            session_start();
            if (!isset($_SESSION["usuario"])) {
            } else {
              echo ($_SESSION["usuario"]["email"]);
            }
            ?>
          </a></li>
        <!--Redirect to pages-->
        <!--<li class="nav-item"><a href="Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->        
        <li class="nav-item"><a href="Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
        <?php
        if (!isset($_SESSION["usuario"])) {
          //echo ('<li class="nav-item"><a href="user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
          }
        }
        ?>
        <li class="nav-item"><a href="about-us.php" class="nav-link active">Quienes somos</a></li>
        <?php
        if (!isset($_SESSION["usuario"])) {
          //echo ('<li class="nav-item"><a href="carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 2) {
            echo ('<li class="nav-item"><a href="carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1) {
            echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
            echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
          } else if ($_SESSION['usuario']['ID_Role'] == 3) {
            echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          echo ('<li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesion</a></li>');
        }
        ?>
      </ul>
    </header>
  </div>

  <!--Content page-->
  <div class="container border border-dark p-4">
    <h2 class="mt-2 mb-5">Quienes Somos</h2>
    <!-- <img src="media/images/exampleP.jpg" alt="">
    <p>holaa</p> -->
    <div class="container">

      <div class="row p-1">
        <div class="container d-flex w-100">
          <div class="col-sm-6">

            <div class="text-start mx-2">
              <p class="fs-5">Somos una pizzería con mucha experiencia, nuestros productos llevan una gran cantidad de condimentos
                de la mejor calidad a un buen precio. Los clientes tienen una gran variedad de pizzas a elegir, si
                alguien tiene alguna necesidad también será escuchada.</p>
              <p class="fs-5">Disponemos de servicio de entrega y recogida en la tienda, solo es necesario unos cuantos clics
                y listo, solo falta esperar, preparar una buena película y disfrutar.</p>
              <p class="fs-4 fw-bolder">¡¡ Buon Appetito. !!</p>
            </div>
          </div>
          <div class="container mx-2 w-100 border p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d808.7520014860046!2d2.8199317716150887!3d41.96774236011738!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12bae7b0432f1b0d%3A0x42986cf1a64dfb08!2sLuciopizza!5e0!3m2!1ses!2ses!4v1620843692157!5m2!1ses!2ses" class="w-100 h-100" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>

        <div class="container mt-5">
          <a href="http://icl2021.epizy.com/" target="_blank" class="fw-bold text-decoration-none mt-5 btn btn-primary">Creada por ICL</a>
          <a href="downloads/app-release.apk" download="Pizzeria_Girona" class="fw-bold text-decoration-none mt-5 btn btn-success">Descarga la app</a>
        </div>
      </div>
    </div>

  </div>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
  </script> -->
  <script src="downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script> -->
  <script src="downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
  </script>
  <!--SweetAlert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="js/about-us.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
</body>

</html>