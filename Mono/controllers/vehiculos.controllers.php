<?php
// Controlador de Vehiculos
error_reporting(0);
require_once('../config/sesiones.php');
require_once("../models/vehiculos.models.php");

$Vehiculos = new Vehiculos;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $Vehiculos->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id = $_POST["id"];
        $datos = array();
        $datos = $Vehiculos->uno($id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $id_cliente = $_POST["id_cliente"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $anio = $_POST["anio"];
        $tipo_motor = $_POST["tipo_motor"];
        $datos = array();
        $datos = $Vehiculos->Insertar($id_cliente, $marca, $modelo, $anio, $tipo_motor);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id = $_POST["id"];
        $id_cliente = $_POST["id_cliente"];
        $marca = $_POST["marca"];
        $modelo = $_POST["modelo"];
        $anio = $_POST["anio"];
        $tipo_motor = $_POST["tipo_motor"];
        $datos = array();
        $datos = $Vehiculos->Actualizar($id, $id_cliente, $marca, $modelo, $anio, $tipo_motor);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = $_POST["id"];
        $datos = array();
        $datos = $Vehiculos->Eliminar($id);
        echo json_encode($datos);
        break;
}
