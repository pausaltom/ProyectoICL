<?php
include("../../../comun/conexionBD.php");

$passActual = mysqli_real_escape_string($mysqli,$_POST['passActual']);
$passNueva = mysqli_real_escape_string($mysqli,$_POST['passNueva']);
$passNueva2 = mysqli_real_escape_string($mysqli,$_POST['passNueva2']);

session_start();


header('Access-Control-Allow-Origin: *');
$email = $_SESSION['usuario']['email'];

//a partir del email podemos sacar la fila del usuario
$check = $mysqli->query("SELECT * FROM usuario WHERE usuario.Email='$email' ");


$row = $check->fetch_object();

//verificamos que la contraseña introducida sea la que está guardada en la bd
if (password_verify($passActual, $row->Password)) {

    if ($passNueva != $passNueva2) {
        echo "las pass no son iguales";
        echo "<p>no son iguales</p>";
        header("Location: ../vista/editarPerfil.php?error=1");
    } else if ($passNueva == $passNueva2) {


        $passwordCrypt = password_hash($passNueva, PASSWORD_DEFAULT);

        $sql = $mysqli->query("UPDATE usuario SET Password = '$passwordCrypt' WHERE Email = '$email'");


        header("Location: ../vista/editarPerfil.php?pcorrecto");
    }
} else {
    header("Location: ../vista/editarPerfil.php?pincorrecto");
}
