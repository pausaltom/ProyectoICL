<?php

include("../../../comun/conexionBD.php");
header('Access-Control-Allow-Origin: *');
$nombreProducto = $_POST['nombreProducto'];
$precioProducto = $_POST['precioProducto'];
$imagen = $_POST['hereName'];



    //creamos una nueva oferta
    $result = $mysqli->query("INSERT INTO oferta (img,Nombre,Precio) VALUES ('$imagen','$nombreProducto','$precioProducto')");
    
    if ($mysqli->error) {
        //echo ($mysqli->error);
        header("../../../admin/Oferta/vista/crearOferta.php?error=Error al crear la oferta");
    }else{
        header("location: ../../../Ofertas/vista/listaOfertas.php"); 
    }
    

echo ($mysqli->error);
$mysqli->close();
