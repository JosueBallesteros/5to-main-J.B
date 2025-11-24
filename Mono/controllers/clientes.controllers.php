<?php
// Controlador de Clientes
error_reporting(0);
require_once('../config/sesiones.php');
require_once("../models/clientes.models.php");

$Clientes = new Clientes;

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $Clientes->todos();
        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id = $_POST["id"];
        $datos = array();
        $datos = $Clientes->uno($id);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo_electronico = $_POST["correo_electronico"];
        $datos = array();
        $datos = $Clientes->Insertar($nombres, $apellidos, $telefono, $correo_electronico);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id = $_POST["id"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $correo_electronico = $_POST["correo_electronico"];
        $datos = array();
        $datos = $Clientes->Actualizar($id, $nombres, $apellidos, $telefono, $correo_electronico);
        echo json_encode($datos);
        break;

    case 'eliminar':
        $id = $_POST["id"];
        $datos = array();
        $datos = $Clientes->Eliminar($id);
        echo json_encode($datos);
        break;
}
