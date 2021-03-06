<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/allPages.css">
    <link rel="stylesheet" href="../../../css/crear-producto.css">
    <link rel="icon" type="image/png" href="../../../uploads/logo-page.png">
    <!-- CSS only -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"> -->
    <link href="../../../downloads/bootstrap-5.0.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <title>Pitzeria girona</title>
    <style>
        body {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <!--Container Header and nav-->
    <div class="container ">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom border-dark mb-sl-3">
            <a href="../../../paginaHome.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="../../../uploads/logo-page.png" alt="" class="icoLogo">
            </a>

            <ul class="nav nav-pills">
                <!--Username-->
                <li class="nav-item "><a href="../../../user/configuracionCuenta/vista/ajustesCuenta.php" class="nav-link text-reset">
                        <?php
                        session_start();
                        echo ($_SESSION["usuario"]["email"]);
                        ?>
                    </a></li>
                <!--Redirect to pages-->
                <!--<li class="nav-item"><a href="../../../Ofertas/vista/listaOfertas.php" class="nav-link active">Ofertas</a></li>-->
                <!--<li class="nav-item"><a href="menus.html" class="nav-link">Menus</a></li>-->
                <!--<li class="nav-item"><a href="reservar.html" class="nav-link active">Reservar</a></li>-->
                <li class="nav-item"><a href="../../../Productos/vista/listaProductos.php" class="nav-link ">Productos</a></li>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
                } else {
                    echo ('<li class="nav-item"><a href="../../../user/pedirAdomicilio/direccion.php" class="nav-link ">Pedir a domicilio</a></li>');
                }
                ?>
                <?php
                if ($_SESSION['usuario']['ID_Role'] == 1 || $_SESSION['usuario']['ID_Role'] == 3) {
                    echo ('<li class="nav-item"><a href="../../../admin/pedido/vista/pedidos.php" class="nav-link">Pedidos</a></li>');
                    echo ('<li class="nav-item"><a href="../../../admin/Usuarios/vista/listaUsuarios.php" class="nav-link">Lista de usuarios</a></li>');
                }
                ?>
                <!--<li class="nav-item"><a href="../../../about-us.php" class="nav-link">Quienes somos</a></li>-->
                <li class="nav-item"><a id="cerrar" class="nav-link">Cerrar sesion</a></li>
            </ul>
        </header>
    </div>

    <!--Content page-->
    <div class="container border border-dark w-100 h-100 p-4 my-5">
        <h1>Crear Oferta</h1>
        <hr>
        <p>
            <?php
            if (isset($_GET['error'])) {
                echo ("Error");
            }
            ?>
        </p>

        <div class="container my-2 d-flex color-White-6 rounded-4">
            <form class="form-check p-3 " id="formimg" action="" method="POST" enctype="multipart/form-data">
                <div class="container my-2 p-0 d-flex color-White-6 rounded-4">
                    <!--Conf img-->
                    <div class="container mx-2">
                        <div id="imagenFoto">
                        </div>
                    </div>
                    <div class="container border-start border-dark mx-2">
                        <input class="my-5 w-auto" type="file" name="imagen" id="imagenInput" size="20" required>
                    </div>
                    <!--Conf data-->
                    <div class="container border-start border-dark mx-2">
                        <input class="btn btn-success my-5" type="button" id="enviar" value="Enviar img al servidor">
                    </div>
                </div>
            </form>
        </div>

        <div class="container my-2 d-flex color-White-6 rounded-4">
            <form action="../modelo/crearOferta.php" id="formularioProducto" method="POST">
                <div class="container my-2 p-0 d-flex color-White-6 rounded-4">
                    <input type="text" id="hereName" name="hereName" hidden>
                    <div class="container mx-2 ">
                        <label for="nombreProducto">Nombre de la Oferta:</label>
                        <input class="my-5 w-auto" type="text" id="nombreProducto" name="nombreProducto" required>
                    </div>
                    <div class="container border-start border-dark mx-2">
                        <label for="precioProducto">Precio de la oferta en ???</label>
                        <input class="my-5 w-100" type="number" min="0" step="0.01" id="precioProducto" name="precioProducto" required></input>
                    </div>
                    <div>
                        <input type="text" style="display: none;" name="imagen" id="imagen">
                        <input type="text" style="display: none;" name="IDcategoria" id="IDcategoria">
                    </div>
                    <div class="container d-block border-start border-dark mx-2">
                        <button class="btn btn-warning  w-auto" type="button" id="btnValidar">Validar Oferta</button>
                        <button class="btn btn-success  my-5" type="submit" id="btnEnviar">Crear Oferta</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="errores">
            <span id="spanErr"></span>
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

    <!--SweetAlert-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../controlador/crearOferta.js"></script>
    <script type="text/javascript">
        window.addEventListener("load", loadEvents);
    </script>
</body>

</html>