<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/allPages.css">
  <link rel="stylesheet" href="../../css/crear-producto.css">
  <link rel="icon" type="image/png" href="../../uploads/logo-page.png">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <script type="text/javascript" src="../controlador/carrito.js"></script>
  <title>Pizzería Girona</title>
  <style>
    table {
      width: 80%;
      margin-top: 5%;
      margin-right: auto;
      margin-left: auto;
    }

    body {
      text-align: center;
    }

    td {
      text-align: center;
    }

    textarea {
      overflow-y: scroll;
      resize: none;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: http://localhost/php/auth/logout.php");
  }
  ?>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
      <a href="../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="../../uploads/logo-page.png" alt="" class="icoLogo">
        <h1>Pizzería Girona</h1>
      </a>
      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-reset">
            <?php
            if (!isset($_SESSION["usuario"])) {
            } else {
              echo ($_SESSION["usuario"]["email"]);
            }
            ?>
          </a></li>
        <!--Redirect to pages-->
        <!--<li class="nav-item"><a href="../../Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
        <li class="nav-item"><a href="../../Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
        <li class="nav-item"><a href="../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>
        <li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>
        <li class="nav-item"><a href="mostrarCarrito.php" class="nav-link active"><img src="" alt=""><i class="bi bi-cart4"></i></a>
          <?php
          if (!isset($_SESSION["usuario"])) {
          } else {
            if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
              echo ('<li class="nav-item"><a href="admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
            }
          }
          if (!isset($_SESSION["usuario"])) {
          } else {
            echo ('<li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesión</a></li>');
          }
          ?>
      </ul>
    </header>
  </div>
  <!--Page content--->
  <div class="container border border-dark">
    <!--Tabla De productos-->
    <div class="container mt-0">
      <!--Tabla De productos-->
      <table id="tablaProductos" style="width: 90%;" class="container p-1">
        <thead class="container border border-dark">
          <th>Imagen</th>
          <th>Nombre Producto</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Acciones</th>
        </thead>
        <tbody id="tbody">
          <?php
          if (isset($_SESSION["Carrito"])) {
            $subTotal = 0;
            foreach ($_SESSION["Carrito"] as $i => $producto) {
              $subTotal +=  ($producto['Precio'] * $producto['Cantidad']);
          ?>
              <tr class="border-bottom border-dark overflow-auto">
                <td><img src="<?php echo "/php/uploads/" . $producto['Imagen']; ?>" width="100px" height="55px" alt="Imagen Producto"></td>
                <td><?php echo $producto['Nombre']; ?></td>
                <td><?php echo $producto['Cantidad']; ?></td>
                <td><?php echo $producto['Precio']; ?>€</td>
                <td><a href="mostrarCarrito.php?i=<?php print_r($i); ?>" class="btn btn-danger "><i class="bi bi-x-octagon"></i></a></td>
              </tr>
          <?php
            }
            if (isset($_REQUEST['i'])) {
              $producto = $_REQUEST['i'];
              unset($_SESSION["Carrito"][$producto]);
              sleep(0.8);
              //header("location: http://localhost/php/carrito/vista/mostrarCarrito.php");
              echo ("<script> window.location='http://localhost/php/carrito/vista/mostrarCarrito.php'</script>");
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    <!--Info del precio-->
    <div class="container border-bottom border-dark mt-1">
      <strong>
        <?php
        //Comprueba si el producto esta vacio
        if (empty($producto)) {
        } else {
          echo ("El precio total del pedido es: " . $subTotal) . "€";
        }
        ?>
      </strong>
    </div>
    <!--Contenedor comentario-->
    <div class="container border-bottom border-dark mt-1 d-block p-2">
      <label for="comentario" class="w-50 my-1">Comentario:</label>
      <textarea class="w-50 h-auto overflow-auto" id="comentario" name="textarea" cols="30" placeholder="Añada un comentario sobre el pedido si lo requiere"></textarea>
    </div>
    <!--Contenedor botones-->
    <div class="container mt-1 p-2">
      <a style="margin-right: 5px;" href="../../Productos/vista/listaProductos.php" class="btn btn-primary">Volver</a>
      <a id="vaciar" class="btn btn-warning">Vaciar Carrito</a>
      <button value="<?php echo ($subTotal); ?>" id="pagar" class="btn btn-success">Pagar</button>
    </div>
  </div>
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
</body>

</html>