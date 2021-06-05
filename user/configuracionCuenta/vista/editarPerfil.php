<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/allPages.css">
  <link rel="stylesheet" href="css/index.css">
  <!-- CSS only -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
  <link href="../../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS Icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <title>Pitzeria Girona</title>
</head>

<body>
  <!--Container Header and nav-->
  <div class="container ">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
      <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="media/images/logo-page.png" alt="" class="icoLogo">
      </a>

      <!--Username-->
      <ul class="nav nav-pills">
        <li class="nav-item "><a href="editarPerfil.php" class="nav-link text-reset">
            <?php
            session_start();
            if (!isset($_SESSION["usuario"])) {
              //include("components/login.html");        
            } else {
              include("components/username.php");
            }
            ?>

          </a></li>
        <!--Redirect to pages-->
        <!-- <li class="nav-item"><a href="ofertas.php" class="nav-link ">Ofertas</a></li> -->
        <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
        <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
        <li class="nav-item"><a href="productos.php" class="nav-link">Productos</a></li>
        <li class="nav-item"><a href="pedidos-domicilio.php" class="nav-link ">Pedir a domicilio</a></li>
        <li class="nav-item"><a href="about-us.php" class="nav-link">Quienes somos</a></li>
        <!--Link carrito-->
        <?php
        if (!isset($_SESSION["usuario"])) {
        } else {
          include("components/carrito.html");
        }
        ?>
        <!--Link logout-->
        <?php
        if (!isset($_SESSION["usuario"])) {
          //include("components/login.html");        
        } else {
          include(" ../../../comun/logout.php");
        }
        ?>
      </ul>
    </header>
  </div>

  <div class="container h-auto w-auto p-3">
    <h1>Configuración del perfil</h1>
    <div class="container border border-dark w-100 h-75 p-4 m-3">
      <h2>Cambiar contraseña</h2>
      <div class="container">
        <form action="../modelo/cambiarContrasena.php" method="POST">
          <label for="pass1">Contraseña actual</label>
          <div class="d-block">
            <input type="password" name="passActual">
          </div>
          <label for="pass1">Nueva contraseña</label>
          <div class="d-block">
            <input type="password" name="passNueva">
          </div>
          <label for="pass1">Confirmar nueva contraseña</label>
          <div class="d-block">
            <input type="password" name="passNueva2">
            <?php
            if (isset($_GET['error']) == 1) {
              echo '<p class="red">Las contraseñas no son iguales</p>';
            } else if (isset($_GET['pcorrecto'])) {
              echo '<p class="green">Se ha actualizado la contraseña</p>';
            }
            ?>
          </div>
          <button class="btn btn-secondary mt-3" type="submit">Cambiar contraseña</button>
        </form>
      </div>
    </div>
    <div class="container border border-dark w-100 h-75 p-4 m-3">
      <h2>Cambiar nombre</h2>
      <div class="container">
        <form action="../modelo/cambiarNombre.php" method="POST">
          <label for="nombre">Nuevo nombre</label>
          <div class="d-block">
            <input type="text" name="nombre">
          </div>
          <?php
          if (isset($_GET['ncorrecto'])) {
            echo '<p class="green">Se ha actualizado el nombre</p>';
          }
          ?>
          <button class="btn btn-secondary mt-3" type="submit">Cambiar nombre</button>
        </form>
      </div>
    </div>
    <div class="container border border-dark w-100 h-75 p-4 m-3">
      <h2>Cambiar teléfono</h2>
      <div class="container">
        <form action="../modelo/cambiarTelefono.php" method="POST">
          <label for="" id="labels">Nuevo Teléfono</label>
          <div class="d-block">
            <input type="text" placeholder="xxx-xxx-xxx" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" name="telefono" id="formBorders">
            <span class="validity"></span>
          </div>
          <?php
          if (isset($_GET['tcorrecto'])) {
            echo '<p class="green">Se ha actualizado el teléfono</p>';
          }
          ?>
          <button class="btn btn-secondary mt-3" type="submit">Cambiar teléfono</button>
        </form>
      </div>
    </div>
  </div>
  </div>



  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
  </script> -->
  <script src="../../../downloads/bootstrap-5.0.1-dist/js/bootstrap.min.js">
  </script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script> -->
  <script src="../../../downloads/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js">
  </script>
</body>