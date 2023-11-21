<?php
require_once("../conexion.php");
require_once("../models/funciones.php");

$funciones =new Funciones();
$body = json_decode(file_get_contents("php://input"), true);

switch($_GET["op"]){
    case "GetAll":
        $datos=$funciones->getProductos();
        echo json_encode($datos);
    break;
    case "insert":
        $datos=$funciones->postInsert($body["FK_id_producto"],$body["nombreProducto"],$body["precio"],$body["cantidad"]);
        echo "se ingreso correctamente";
    break;
    case "insertVenta":
        $datos=$funciones->postVenta($body["FK_id_producto"],$body["cantidad"]);
        echo "tu venta fue hecha correctamente";
    break;
    case "Delete":
        $datos=$funciones->delete($body["id_producto"]);
        echo "eliminado correctamente";
    break;
    }

?>
