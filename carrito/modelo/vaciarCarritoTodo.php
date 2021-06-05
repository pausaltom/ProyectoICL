<?php
session_start();
if (isset($_SESSION["Carrito"])) {
  unset($_SESSION["Carrito"]);
  echo $_SESSION["Carrito"];
  // header("location: http://localhost/php/Productos/vista/listaProductos.php");
  header('Location:' . getenv('HTTP_REFERER'));
} else {
  header("location: http://localhost/php/Productos/vista/listaProductos.php");
}
