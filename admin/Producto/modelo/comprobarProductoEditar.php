<?php

session_start();
if (!isset($_SESSION["usuario"]) || ($_SESSION['usuario']['ID_Role'] == '2')) {
   header("location: http://localhost/php/comun/logout.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $nombre = $_POST['nombreProducto'];
   $precio = $_POST['precioProducto'];
   $id = $_POST['idProducto1'];


   include("../../../comun/conexionBD.php");


   $result = $mysqli->query("SELECT * from producto WHERE ID_Producto = $id");
   $row = $result->fetch_object();

   $nombreProducto = $row->Nombre;

   $result1 = $mysqli->query("SELECT * from producto WHERE Nombre = '$nombre'");
   $row2 = $result1->fetch_object();
   echo ($mysqli->error);

   if (mysqli_num_rows($result1) != 0) {
      if ($row2->Nombre == $row->Nombre) {
         echo "Producto válido/0";
      }else{
         echo ('Ya existe un Producto con este Nombre/1');
      }
   } else {
      if ($nombre == "" || $precio == "") {
         echo "Faltan campos por rellenar/2";
      } else {
         echo "Producto válido/0";
      }
   }
   //$result->free();
   $mysqli->close();
}
?>