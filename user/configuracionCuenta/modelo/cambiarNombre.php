<?php


session_start();

include("../../../comun/conexionBD.php");



$nombre  = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['nombre']);

header('Access-Control-Allow-Origin: *');
$email = $_SESSION['usuario']['email'];


//a partir del email podemos sacar la fila del usuario
$check = $mysqli->query("SELECT * FROM usuario WHERE usuario.Email='$email' ");


$row = $check->fetch_object();

if (mysqli_num_rows($check) > 0) {


    $sql = $mysqli->query("UPDATE usuario SET Nombre = '$nombre' WHERE Email = '$email'");


    header("Location: ../vista/editarPerfil.php?ncorrecto");
} else {
    echo "Error no se ha podido cambiar el nombre";
}

// function cleane($string)
// {
//     $string = str_replace(' ', '-', $string); // Replaces spaces with hyphens.
//     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
// }
