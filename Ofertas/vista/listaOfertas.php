<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/allPages.css">
  <link rel="icon" type="image/png" href="../../uploads/logo-page.png">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Pitzeria girona</title>

  <style>
    td {
      text-align: center;
    }

    input {
      margin-right: 10px;

    }
  </style>
</head>

<body>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
      <a href="../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="../../uploads/logo-page.png" alt="" class="icoLogo">
      </a>

      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="../../user/configuracionCuenta/vista/ajustesCuenta.php" class="nav-link text-reset">
            <?php
            session_start();
            if (!isset($_SESSION["usuario"])) {
            } else {
              echo ($_SESSION["usuario"]["email"]);
            }
            ?>
          </a></li>
        <!--Redirect to pages-->
        <!--<li class="nav-item"><a href="listaOfertas.php" class="nav-link active">Ofertas</a></li>-->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
        <li class="nav-item"><a href="../../Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
        <?php
        if (!isset($_SESSION["usuario"])) {
          echo ('<li class="nav-item"><a href="../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
          echo ('<li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          } else {
            echo ('<li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
          //echo ('<li class="nav-item"><a href="carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 2) {
            echo ('<li class="nav-item"><a href="../../carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
          }
        }
        ?>
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
            echo ('<li class="nav-item"><a href="../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
            echo ('<li class="nav-item"><a href="../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
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

  <!--Page content-->
  <div id="containerProducts" class="container border border-dark w-100 my-1">
    <div class="text-center border-bottom border-dark my-1">
      <h1 class="h2 mt-2">Ofertas</h1>
    </div>
    <!--Contenedor de productos-->
    <table id="tablaProductos" style="width: 90%;" class="container w-100 text-center my-1">
      <!--<thead class="container border border-dark rounded-4 color-White-6 my-3 w-80 h-25 p-2 mx-1 d-flex text-start">
        <th>Imagen:</th>
        <th>Nombre Producto:</th>
        <th>Precio:</th>
        <th>Acciones:</th>
      </thead>-->
      <tbody id="tbody">
      </tbody>
    </table>

    <div id="paginacion" class="container p-2 mb-2 text-center">
      <button class="btn btn-primary" id="primera">Primera</button>
      <button class="btn btn-primary" id="anterior">Anterior</button>
      <!--Total de paginas-->
      <button class="btn btn-primary disabled" id="contadorActual"></button>
      <button class="btn btn-primary disabled" id="contador"></button>
      <!---->
      <button class="btn btn-primary" id="siguiente">Siguiente</button>
      <button class="btn btn-primary" id="ultima">??ltima</button>
      <?php
      if (!isset($_SESSION["usuario"])) {
        echo ('<a class="btn btn-success hide" id="crearProd" href="../../admin/Oferta/vista/crearOferta.php">Crear Oferta</a>');
      } else {
        if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
          echo ('<a class="btn btn-success" id="crearProd" href="../../admin/Oferta/vista/crearOferta.php">Crear Oferta</a>');
        } else {
          echo ('<a class="btn btn-success hide" id="crearProd" href="../../admin/Oferta/vista/crearOferta.php">Crear Oferta</a>');
        }
      }
      ?>
    </div>
  </div>


  <a id="carrito" href="../../carrito/vista/mostrarCarrito.php" class="hide">Carrito compra</a>

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
  </script> -->
  <script src="../../downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script> -->
  <script src="../../downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
  </script>

  <!--SweetAlert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="../controlador/javascriptProductos.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
</body>

</html>