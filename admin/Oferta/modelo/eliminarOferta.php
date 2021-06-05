<?php
        session_start();
        if(!isset($_SESSION["usuario"])||($_SESSION['usuario']['ID_Role'] =='2')){
             header("location: http://localhost/php/comun/logout.php");
        }
        include("../../../comun/conexionBD.php");

        $id=$_GET['idProd'];
        
        //echo($id);
        $userEmail=$_SESSION['usuario'];
        $usuarioUpdated=$mysqli->query("DELETE FROM oferta WHERE oferta.ID_Oferta=$id");    
        
        echo ($mysqli->error);        
        header("location: ../../../Ofertas/vista/listaOfertas.php");   
        
        $usuarioUpdated->free();
        $mysqli->close();
?>