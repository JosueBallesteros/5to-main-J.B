// Funciones JS para Clientes
function init() {
    $("#form_clientes").on("submit", (e) => {
        GuardarEditar(e);
    });
}
const ruta = "../../controllers/clientes.controllers.php?op=";

$().ready(() => {
    CargaLista();
});

var CargaLista = () => {
    var html = "";
    $.get(ruta + "todos", (ListClientes) => {
        ListClientes = JSON.parse(ListClientes);
        $.each(ListClientes, (index, cliente) => {
            html += `<tr>
            <td>${index + 1}</td>
            <td>${cliente.nombres}</td>
            <td>${cliente.apellidos}</td>
            <td>${cliente.telefono}</td>
            <td>${cliente.correo_electronico}</td>
            <td>
                <button class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#ModalClientes" onclick='uno(${cliente.id})'>Editar</button>
                <button class='btn btn-danger' onclick='eliminar(${cliente.id})'>Eliminar</button>
            </td>
            </tr>`;
        });
        $("#ListaClientes").html(html);
    });
};

var GuardarEditar = (e) => {
    e.preventDefault();
    var DatosFormulario = new FormData($("#form_clientes")[0]);
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
    $.post(ruta + "uno", { id: id }, (cliente) => {
        cliente = JSON.parse(cliente);
        document.getElementById("id").value = cliente.id;
        document.getElementById("nombres").value = cliente.nombres;
        document.getElementById("apellidos").value = cliente.apellidos;
        document.getElementById("telefono").value = cliente.telefono;
        document.getElementById("correo_electronico").value = cliente.correo_electronico;
    });
};

var eliminar = (id) => {
    if (confirm("¿Estás seguro de eliminar este cliente?")) {
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
    document.getElementById("nombres").value = "";
    document.getElementById("apellidos").value = "";
    document.getElementById("telefono").value = "";
    document.getElementById("correo_electronico").value = "";
    $("#ModalClientes").modal("hide");
};

init();
