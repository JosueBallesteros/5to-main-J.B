<?php
// Modelo de Clientes
require_once('../config/conexion.php');

class Clientes
{
    public function todos()
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `clientes`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function uno($id)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `clientes` WHERE id = $id";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    public function Insertar($nombres, $apellidos, $telefono, $correo_electronico)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `clientes` (nombres, apellidos, telefono, correo_electronico) VALUES ('$nombres', '$apellidos', '$telefono', '$correo_electronico')";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return 'Error al insertar en la base de datos';
        }
        $con->close();
    }

    public function Actualizar($id, $nombres, $apellidos, $telefono, $correo_electronico)
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoConectar();
        $cadena = "UPDATE `clientes` SET nombres='$nombres', apellidos='$apellidos', telefono='$telefono', correo_electronico='$correo_electronico' WHERE id=$id";
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
        $cadena = "DELETE FROM `clientes` WHERE id = $id";
        if (mysqli_query($con, $cadena)) {
            return 'ok';
        } else {
            return false;
        }
        $con->close();
    }
}
