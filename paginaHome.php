<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/allPages.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" type="image/png" href="uploads/logo-page.png">
    <script src="js/slideShow.js"></script>
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">


    <title>Pitzeria Girona</title>

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
            <a href="paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="uploads/logo-page.png" alt="" class="icoLogo">
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="user/configuracionCuenta/vista/ajustesCuenta.php" class="nav-link text-reset">
                        <?php
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
                <li class="nav-item"><a href="user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>
                <li class="nav-item"><a href="about-us.php" class="nav-link">Quienes somos</a></li>
                <?php
                if (!isset($_SESSION["usuario"])) {
                    //echo ('<li class="nav-item"><a href="carrito/carrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
                } else {
                    if ($_SESSION['usuario']['ID_Role'] == 2) {
                        echo ('<li class="nav-item"><a href="carrito/vista/mostrarCarrito.php" class="nav-link"><img src="" alt=""><i class="bi bi-cart4"></i></a>');
                    }
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
                <?php
                if (!isset($_SESSION["usuario"])) {
                } else {
                    echo ('<li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesion</a></li>');
                }
                ?>
            </ul>
        </header>
    </div>

    <?php
    if ($_SESSION['usuario']['ID_Role'] == 2) {
        echo ('
        <!--Content page-->
    <div class="container border border-dark  w-100 mx-15 d-flex mt-4 py-4">
        <!--Contenedor ofertas-->
        <div class="container w-100 mx-1 border border-dark p-0">
            <div class="container border-bottom border-dark">
                <h2>Ofertas</h2>
            </div>
            <div id="carouselExampleSlidesOnly" class="carousel slide mx-0 mt-5" data-ride="carousel">
                <div class="carousel-inner h-100">
                    <!--Contenido 1-->
                    <div class="carousel-item active p-1">
                        <!-- media/images/ofertas/Delicheese.jpg -->
                        <a href="Productos/vista/listaProductos.php">
                            <img id="imagenC" class="d-block w-100" alt="1 image">
                        </a>
                        <script type="text/javascript">
                            window.addEventListener("load", changeImg2);
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
        ');
    } elseif ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
        header("location: http://localhost/php/Productos/vista/listaProductos.php");
    }
    ?>




    <!--    <h1>Bienvenidos a la mejor Pizzeria</h1>

    <p>Si estas aqui es porqué ya estas registrado</p>
    <p><a href="user/pedirAdomicilio/direccion.php">Introducir Dirección</a></p>
    <p><a href="Productos/vista/listaProductos.html">Productos</a></p>
    <p><a href="user/configuracionCuenta/vista/ajustesCuenta.html">Cambiar Ajustes</a></p>
    /*<?php
        //if ($_SESSION['usuario']['ID_Role'] == '3' || $_SESSION['usuario']['ID_Role'] == '1') {
        ?>
        <p><a href="admin/Usuarios/vista/listaUsuarios.html">Lista Usuarios</a></p>
    <?php
    //}
    ?>*/
    <p><a href="comun/logout.php">Cerrar Sessión</a></p>-->
    <!--SweetAlert-->
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/about-us.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>
</body>

</html>