// Funciones JS para Vehiculos
function init() {
    $("#form_vehiculos").on("submit", (e) => {
        GuardarEditar(e);
    });
}
const ruta = "../../controllers/vehiculos.controllers.php?op=";

$().ready(() => {
    CargaLista();
    cargaClientes();
});

var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListVehiculos) => {
        ListVehiculos = JSON.parse(ListVehiculos);
        $.each(ListVehiculos, (index, vehiculo) => {
            html += `<tr>
            <td>${index + 1}</td>
            <td>${vehiculo.nombres} ${vehiculo.apellidos}</td>
            <td>${vehiculo.marca}</td>
            <td>${vehiculo.modelo}</td>
            <td>${vehiculo.anio}</td>
            <td>${vehiculo.tipo_motor}</td>
            <td>
                <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalVehiculos" onclick='uno(${vehiculo.id})'>Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${vehiculo.id})'>Eliminar</button>
            </td>
            </tr>`;
        });
        $("#ListaVehiculos").html(html);
    });
};

var cargaClientes = () => {
    var html = "<option value=''>Seleccione un Cliente</option>";
    $.get("../../controllers/clientes.controllers.php?op=todos", (ListClientes) => {
        ListClientes = JSON.parse(ListClientes);
        $.each(ListClientes, (index, cliente) => {
            html += `<option value="${cliente.id}">${cliente.nombres} ${cliente.apellidos}</option>`;
        });
        $("#id_cliente").html(html);
    });
}

var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormulario = new FormData($("#form_vehiculos")[0]);
    var accion = "";
    var id = document.getElementById("id").value;

    if (id > 0) {
        accion = ruta + "actualizar";
    } else {
        accion = ruta + "insertar";
    }

    $.ajax({
        url: accion,
        type: "post",
        data: DatosFormulario,
        processData: false,
        contentType: false,
        cache: false,
        success: (respuesta) => {
            respuesta = JSON.parse(respuesta);
            if (respuesta == "ok") {
                alert("Se guardó con éxito");
                CargaLista();
                LimpiarCajas();
            } else {
                alert("Error al guardar");
            }
        },
    });
};

var uno = (id) => {
    $.post(ruta + "uno", { id: id }, (vehiculo) => {
        vehiculo = JSON.parse(vehiculo);
        document.getElementById("id").value = vehiculo.id;
        document.getElementById("id_cliente").value = vehiculo.id_cliente;
        document.getElementById("marca").value = vehiculo.marca;
        document.getElementById("modelo").value = vehiculo.modelo;
        document.getElementById("anio").value = vehiculo.anio;
        document.getElementById("tipo_motor").value = vehiculo.tipo_motor;
    });
};

var eliminar = (id) => {
    if (confirm("¿Estás seguro de eliminar este vehículo?")) {
        $.post(ruta + "eliminar", { id: id }, (respuesta) => {
            respuesta = JSON.parse(respuesta);
            if (respuesta == "ok") {
                alert("Se eliminó con éxito");
                CargaLista();
            } else {
                alert("Error al eliminar");
            }
        });
    }
};

var LimpiarCajas = () => {
    document.getElementById("id").value = "";
    document.getElementById("id_cliente").value = "";
    document.getElementById("marca").value = "";
    document.getElementById("modelo").value = "";
    document.getElementById("anio").value = "";
    document.getElementById("tipo_motor").value = "dos_tiempos";
    $("#ModalVehiculos").modal("hide");
};

init();
