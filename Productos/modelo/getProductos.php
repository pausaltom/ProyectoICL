<?php

include("../../comun/conexionBD.php");
    
$registrosPorPag=3;

$pagina=$_GET["pagina"];
$categoria=$_GET["categoria"];

$empezar_desde = ($pagina-1) * $registrosPorPag;

if($categoria !="0") {
    $query1="SELECT * from producto WHERE ID_Categoria='$categoria'";
    //$query2="SELECT * from producto WHERE ID_Categoria='$categoria' ORDER BY Nombre ASC LIMIT $empezar_desde,$registrosPorPag";
    $query2="SELECT p.ID_Producto,p.img,p.Nombre,p.Precio,c.Categoria from producto p inner join categoria c ON p.ID_Categoria=c.ID_Categoria where p.ID_Categoria=$categoria ORDER BY Nombre ASC LIMIT $empezar_desde,$registrosPorPag";
}else {
    $query1="SELECT * from producto";
    $query2="SELECT p.ID_Producto,p.img,p.Nombre,p.Precio,c.Categoria from producto p inner join categoria c ON p.ID_Categoria=c.ID_Categoria ORDER BY Nombre ASC LIMIT $empezar_desde,$registrosPorPag";
    //$query2="SELECT * from producto ORDER BY Nombre ASC LIMIT $empezar_desde,$registrosPorPag";
}

$result = $mysqli->query($query1);
echo ($mysqli->error);

$numRegistros = mysqli_num_rows($result);

$total_paginas=ceil($numRegistros/$registrosPorPag);

$resultPagianado = $mysqli->query($query2);
while ($row = $resultPagianado->fetch_object()) {
    echo ($row->ID_Producto . " / " . $row->img ." / ".$row->Nombre . " / ".$row->Precio ." / ".$row->Categoria. "//");
}
echo("#");
echo($total_paginas);



$result->free();
$mysqli->close();
?>