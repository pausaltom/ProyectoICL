<?php
$telefono = $_POST['telefono'];


session_start();


include("../conexionBD.php");
header('Access-Control-Allow-Origin: *');
$email = $_SESSION['usuario']['email'];


//a partir del email podemos sacar la fila del usuario
$check = $mysqli->query("SELECT * FROM usuario WHERE usuario.Email='$email' ");

$row = $check->fetch_object();

if (mysqli_num_rows($check) > 0) {


    $sql = $mysqli->query("UPDATE usuario SET Telefono = '$telefono' WHERE Email = '$email'");


    header("Location: ../../editarPerfil.php?tcorrecto");
} else {
    echo "Error no se h apodido cambiar el teléfono";
}
