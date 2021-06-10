<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/allPages.css">
    <link rel="icon" type="image/png" href="../../uploads/logo-page.png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title>Pizzería girona</title>    
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
                <h1>Pizzería Girona</h1>
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="../../user/configuracionCuenta/vista/editarPerfil.php" class="nav-link text-reset">
                        <?php
                        echo ($_SESSION["usuario"]["email"]);
                        ?>
                    </a></li>
                <!--Redirect to pages-->
                <!--<li class="nav-item"><a href="Ofertas/vista/listaOfertas.php" class="nav-link ">Ofertas</a></li>-->
                <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
                <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
                <li class="nav-item"><a href="../../Productos/vista/listaProductos.php" class="nav-link">Productos</a></li>
                <li class="nav-item"><a href="direccion.php" class="nav-link active">Pedir a domicilio</a></li>
                <li class="nav-item"><a href="../../about-us.php" class="nav-link">Quienes somos</a></li>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 2) {
                    echo ('<li class="nav-item"><a href="../../carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
                }
                ?>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1) {
                    echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
                } else if ($_SESSION['usuario']['ID_Role'] == 3) {
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
                }
                ?>
                <li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesión</a></li>
            </ul>
        </header>
    </div>

    <!--Page content-->    
        <div class="container border border-dark w-100 h-75 p-4">
            <div class=" border border-dark text-center">
                <h2>Dirección</h2>
            </div>
            <p id="errormsg"></p>
            <div class="border-top border-dark h-100">
                <div class="container border my-4 h-50 p-4 text-center">
                    <!-- Selects prov muni cp-->
                    <label for="provincia">Provincia*: </label>
                    <select id="provincia" required>
                        <option id="optProv">Seleccione una provincia</option>
                    </select>
                    <label for="municipio">Municipio*: </label>
                    <select id="municipio" required>
                        <option id="optMun" value="">Seleccione un municipio</option>
                    </select>
                    <label for="cp">Cp*: </label>
                    <select id="cp" required>
                        <option id="optCp" value="">Seleccione un código postal</option>
                    </select>
                </div>
                <div class="container border my-4 h-50 p-4 text-center">
                    <!-- Inputs -->
                    <!--Direccion-->
                    <label for="Direccion">Dirección*: </label>
                    <input id="Direccion" type="text" placeholder="Ej:c/Ramón turró"></input>
                    <!--Número-->
                    <label for="Numero">Número*: </label>
                    <input id="Numero" type="number" placeholder="Ej:5"></input>
                    <!--Piso-->
                    <label for="Piso">Piso: </label>
                    <input id="Piso" type="text" placeholder=""></input>
                </div>
                <div class="container border my-4 h-50 p-4 text-center">
                    <!--Bloque-->
                    <label for="Bloque">Bloque: </label>
                    <input id="Bloque" type="text" placeholder=""></input>
                    <!--Puerta-->
                    <label for="Puerta">Puerta: </label>
                    <input id="Puerta" type="text" placeholder=""></input>
                    <!--Escalera-->
                    <label for="Escalera">Escalera: </label>
                    <input id="Escalera" type="text" placeholder=""></input>
                </div>
                <div class="container text-center border my-4 p-4">
                    <p style="color: rgb(112, 112, 112);">*Los campos marcados con un * son necesarios</p>

                    <div style="width: 300px; height: auto; text-align: left;">
                        <p id="errormsg"></p>
                    </div>
                    <input type="button" value="Guardar dirección" id="botonEnviar" class="btn btn-success w-25"></input>
                </div>
            </div>
        </div> 

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!--SweetAlert-->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript" src="javascriptDireccion.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>    
</body>

</html>