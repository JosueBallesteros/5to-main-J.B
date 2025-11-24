<?php
// Modelo de Vehiculos
require_once('../config/conexion.php');

class Vehiculos
{
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT vehiculos.*, clientes.nombres, clientes.apellidos FROM `vehiculos` INNER JOIN clientes ON vehiculos.id_cliente = clientes.id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `vehiculos` WHERE id = $id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function Insertar($id_cliente, $marca, $modelo, $anio, $tipo_motor)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `vehiculos` (id_cliente, marca, modelo, anio, tipo_motor) VALUES ($id_cliente, '$marca', '$modelo', $anio, '$tipo_motor')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($id, $id_cliente, $marca, $modelo, $anio, $tipo_motor)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE `vehiculos` SET id_cliente=$id_cliente, marca='$marca', modelo='$modelo', anio=$anio, tipo_motor='$tipo_motor' WHERE id=$id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al actualizar el registro';
        }
        $con->close();
    }

    public function Eliminar($id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "DELETE FROM `vehiculos` WHERE id = $id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
