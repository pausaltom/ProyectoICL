<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="30"><!-- al poner este metadata la pagina se recarga automáticamente cada x segundos en este caso  30 segundos  -->
  <link rel="stylesheet" href="../../css/allPages.css">
  <link rel="stylesheet" href="../../css/crear-producto.css">
  <link rel="icon" type="image/png" href="../../uploads/logo-page.png">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Carrito de la compra</title>
  <style>
    td {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location: http://localhost/php/auth/login.html");
  }
  ?>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
      <a href="../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="../../uploads/logo-page.png" alt="" class="icoLogo">
        <h1>Pitzeria Girona</h1>
      </a>

      <ul class="nav nav-pills">
        <!--Username-->
        <li class="nav-item "><a href="../../user/configuracionCuenta/vista/ajustesCuenta.php" class="nav-link text-reset">
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
  <!--Page content--->
  <div class="container border border-dark p-1">
    <!--Tabla De productos-->
    <?php
    include("../../comun/conexionBD.php");
    $email = $_SESSION['usuario']['email'];
    $result = $mysqli->query("SELECT * FROM usuario WHERE Email='$email'");
    $r = $result->fetch_object();
    $verPedido = $mysqli->query("SELECT p.ID_Pedido as ID_Pedido,p.Comentario,p.Activo,u.Nombre,p.PrecioTotal,p.Hora,e.Estado,u.Direccion,u.Telefono, p.ID_Estado FROM pedido p, usuario u, estado_pedido e WHERE (p.ID_Usuario=$r->ID_Usuario) AND (p.ID_Usuario=u.ID_Usuario AND p.ID_Estado=e.ID_Estado) AND(p.Activo=1)");


    echo ($mysqli->error);
    if (mysqli_num_rows($verPedido) <= 0) {
    ?>
      <script type="text/javascript">
        window.location = "../../Productos/vista/listaProductos.php?estadoActivo=0";
      </script>

    <?php
    }



    $row = $verPedido->fetch_object();
    ?>

    <div class="container text-center">
      <!--Num pedido-->
      <div class="container p-1 border border-dark">
        <label for="tablaProductos">
          <h2>Pedido <?php echo "P0000" . $row->ID_Pedido ?></h2>
        </label>
      </div>
      <!--Estado pedido-->
      <div class="container border border-dark mt-2">
        <label>
          <h2 class="d-flex">EstadoPedido </h2>
        </label>
      </div>
      <div class="container border-start border-end border-dark border-2 mt-2 text-center p-2 ">        
          <?php
          if ($row->ID_Estado == 6) {
            echo'<div class="border border-dark p-0" style="background-color:#F12222;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          } else if ($row->ID_Estado == 5) {            
            echo'<div class="border border-dark p-0" style="background-color:yellow;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          } else if ($row->ID_Estado == 4) {            
            echo'<div class="border border-dark p-0" style="background-color:#85F130;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          } else if ($row->ID_Estado == 3) {            
            echo'<div class="border border-dark p-0" style="background-color:#85C1E9;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          } else if ($row->ID_Estado == 2) {            
            echo'<div class="border border-dark p-0" style="background-color:#D9FF6B;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          } else {
            echo'<div class="border border-dark p-0" style="background-color:#F12222;">';
            echo "<h4>$row->Estado</h4>";
            echo "</div>";
          }
          ?>        
      </div>
      <!--Table-->
      <div class="container border-start border-end border-dark border-2 mt-2 text-center p-2">
        <table id="tablaProductos" class="w-100">
          <thead class="border border-dark">
            <th>Imagen</th>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
          </thead>
          <tbody id="tbody" class=" overflow">
            <?php
            $lineasPedido = $mysqli->query("SELECT l.ID_Pedido, l.Cantidad, p.Nombre,p.Precio,p.img from linea_pedido l, producto p where l.ID_Producto=p.ID_Producto AND l.ID_Pedido=$row->ID_Pedido");
            while ($productos = $lineasPedido->fetch_object()) {
            ?>
              <tr class="border-bottom border-dark overflow-auto">
                <td><img src="<?php echo "/php/uploads/" . $productos->img; ?>" width="100px" height="60px" alt="Imagen Producto"></td>
                <td><?php echo $productos->Nombre; ?></td>
                <td><?php echo $productos->Cantidad; ?></td>
                <td><?php echo $productos->Precio;?>€</td>
              </tr>
            <?php
            }

            ?>
            <tr class="border-bottom border-dark overflow-auto">
              <th>Total a pagar</th>
              <td></td>
              <td></td>
              <td><strong><?php echo$row->PrecioTotal?>€</strong></td>
            </tr>
          </tbody>
        </table>
      </div>

      <!--Info-->
      <!--Titulo-->
      <div class="border mt-2 border-dark">
        <label for="DatosPersonales ">
          <h2>Datos Personales</h2>
        </label>
      </div>
      <div class="container border-start border-end border-dark border-2 mt-2 text-center p-2">
        <div id="DatosPersonales" class=" mt-2">
          <div class="border border-dark "><b>Nombre:</b> <?php echo $row->Nombre; ?></div>
          <div class="border border-dark mt-1"><b>Telefono:</b> <?php echo $row->Telefono; ?></div>
          <!--Direccion-->
          <div class="border border-dark mt-1 p-2">
            <!--Titulo-->
            <div class="border-bottom border-dark">
              <h5>Direccion</h5>
            </div>
            <!--Tabla contendedor-->
            <div class="mt-1 p-2">
              <div style="display:none;" id="direccion"><?php echo $row->Direccion; ?></div>
              <!--Tabla direccion-->
              <table class="w-100">
                <thead class="border border-dark ">
                  <th>Provincia</th>
                  <th>Municipio</th>
                  <th>Cp</th>
                  <th>Dirección</th>
                  <th>Número</th>
                  <th>Piso</th>
                  <th>Bloque</th>
                  <th>Puerta</th>
                  <th>Escalera</th>
                </thead>
                <tbody class="border-bottom border-dark">
                  <td>
                    <p id="provincia"></p>
                  </td>
                  <td>
                    <p id="municipio"></p>
                  </td>
                  <td>
                    <p id="cp"></p>
                  </td>
                  <td>
                    <p id="Direccion"></p>
                  </td>
                  <td>
                    <p id="Numero"></p>
                  </td>
                  <td>
                    <p id="Piso"></p>
                  </td>
                  <td>
                    <p id="Bloque"></p>
                  </td>
                  <td>
                    <p id="Puerta"></p>
                  </td>
                  <td>
                    <p id="Escalera"></p>
                  </td>
                </tbody>
              </table>

            </div>
          </div>

          <!--Comentario-->
          <div class="border border-dark mt-1 p-2">
            <label for="Comentario">
              <h5>Comentario</h5>
            </label>
            <div class="border border-dark border-1 mt-1 p-3"><?php echo $row->Comentario; ?></div>
          </div>
          <!--Hora entrega-->
          <div class="border border-dark mt-1 p-2">
            <label for="Comentario">
              <h5>Hora de entrega</h5>
            </label>
            <div class="border border-dark border-1 mt-1 p-3"><?php echo $row->Hora; ?></div>
          </div>
        </div>
      </div>
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
  <script type="text/javascript" src="../controlador/mostrarresumenPago.js"></script>
  <script type="text/javascript">
    window.addEventListener("load", loadEvents);
  </script>
</body>

</html>