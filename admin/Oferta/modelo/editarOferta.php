<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] =='2')){
             header("location: http://localhost/php/comun/logout.php");
        }
        include("../../../comun/conexionBD.php");

        $id=$_POST['idProducto1'];
        $nombreProducto=$_POST['nombreProducto'];
        $precioProducto=$_POST['precioProducto'];

        $productUpdated=$mysqli->query("UPDATE oferta SET Nombre = '$nombreProducto' , Precio='$precioProducto' WHERE ID_Oferta=$id");    
        echo ($mysqli->error);
        if(!$mysqli->error){
            header("location: ../../../Ofertas/vista/listaOfertas.php");
        }
        $productUpdated->free();
        $mysqli->close();
?>