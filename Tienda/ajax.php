<?php
require_once "config/conexion.php";
if (isset($_POST)) {
    if ($_POST['action'] == 'buscar') {
        $array['datos'] = array();
        $total = 0;
        for ($i=0; $i < count($_POST['data']); $i++) { 
            $id = $_POST['data'][$i]['id'];
            $query = mysqli_query($conexion, "SELECT * FROM Producto WHERE Id = $id");
            $result = mysqli_fetch_assoc($query);
            $data['id'] = $result['Id'];
            $data['precio'] = $result['Precio'];
            $data['nombre'] = $result['Nombre'];
            $total = $total + $result['Precio'];
            array_push($array['datos'], $data);
        }
        $array['total'] = $total;
        echo json_encode($array);
        die();
    }
}

?>