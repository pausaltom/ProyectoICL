<?php
$nombre = $_POST['nombre'];


session_start();


include("../conexionBD.php");
header('Access-Control-Allow-Origin: *');
$email = $_SESSION['usuario']['email'];


//a partir del email podemos sacar la fila del usuario
$check = $mysqli->query("SELECT * FROM usuario WHERE usuario.Email='$email' ");


$row = $check->fetch_object();

if (mysqli_num_rows($check) > 0) {


    $sql = $mysqli->query("UPDATE usuario SET Nombre = '$nombre' WHERE Email = '$email'");


    header("Location: ../../editarPerfil.php?ncorrecto");
} else {
    echo "Error no se ha podido cambiar el nombre";
}
