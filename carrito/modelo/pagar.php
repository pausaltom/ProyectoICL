<?php
    session_start();
    if(!isset($_SESSION["usuario"])){
        header("location: http://localhost/php/auth/login.html");
    }
    include("../../comun/conexionBD.php");     
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $comentario= mysqli_real_escape_string($mysqli,$_POST['comentario']);
        $subtotal=$_POST['subtotal'];
        $email=$_SESSION['usuario']['email'];
        $resultado = $mysqli->query("SELECT * from usuario where Email='$email'");
        $row = $resultado->fetch_object();
        $id_usuario=$row->ID_Usuario;
        //echo $id_usuario;
        date_default_timezone_set("Europe/Madrid");
        $hora =date("H:i:s");
        if($comentario == ""){
            $comentario = "Sin Comentarios";
        }
    
        $horaAsignada = date('H:i:s', strtotime('+30 minutes', strtotime($hora)));
        //echo $horaAsignada."". $subtotal;
        $comprobarExistePedidoActivo = $mysqli->query("SELECT * from pedido where ID_Usuario=$id_usuario AND Activo=1");
        echo ($mysqli->error); 
        if (mysqli_num_rows($comprobarExistePedidoActivo) == 0) {
            $sql = "INSERT INTO pedido (Comentario, Hora, PrecioTotal,Activo, ID_Usuario) VALUES ('$comentario','$horaAsignada',$subtotal,1,$id_usuario)";
            $result=$mysqli->query($sql);
            $IDultPedido= $mysqli->query("SELECT MAX(ID_Pedido) AS ID_Pedido from pedido");
            $fila = $IDultPedido->fetch_object(); 
            $id_pedido =$fila->ID_Pedido; 
            echo ($mysqli->error);       
            if(!$mysqli->error){ 
                foreach ($_SESSION["Carrito"] as $i => $producto) {
                    $cantidad= $producto['Cantidad'];
                    $id_producto= $producto['ID'];
                    $sqlLinea = "INSERT INTO linea_pedido (Cantidad,ID_Pedido,ID_Producto) VALUES ($cantidad,'$id_pedido',$id_producto)";
                    $insertarLinea=$mysqli->query($sqlLinea);  
                }
                unset($_SESSION["Carrito"]);
                $mysqli->close();    
                echo("pago realizado Correctamente/1");
            }else{
                echo("Fallo al realizar el pago/0");
            }
        }else{
            echo("Usted ya tiene un pedido Activo, por favor termine el pedido antes de iniciar otro/2");
            
        }
        
    }
?>