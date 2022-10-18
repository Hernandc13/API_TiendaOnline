<?php
 require_once "config/conexion.php";


if(isset($_POST['txtnombre'])) {
    
$nombre=$_POST['txtnombre'];
$descripcion=$_POST['txtdescripcion'];
$precio=$_POST['txtprecio'];
$existencia=$_POST['txtexistencia'];
$categoria=$_POST['txtcategoria'];
$imagen = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));

$insertSQL=("INSERT INTO producto VALUES ('','$imagen','$nombre','$descripcion','$precio','$existencia','$categoria')");
mysqli_query($conexion, $insertSQL);
header("Location:index.php");

}

?>