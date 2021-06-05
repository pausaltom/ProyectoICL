<?php

    //$mysqli = new mysqli("localhost", "Cliente", "1234", "icl");
    $server="localhost";
    $user="root";
    $passwor="";
    $name="icl";
    //Usuario superAdmin (no es recomendable usar el usuario root)
    // $server="localhost";
    // $user="superAdmin";
    // $password="hFe7anf1retwahAu";
    // $name="icl";
    $mysqli = new mysqli("$server", "$user", "$passwor", "$name");
    if ($mysqli->connect_errno) {
        echo ("Connect failed: " . $mysqli->connect_error);
        exit();
    }
