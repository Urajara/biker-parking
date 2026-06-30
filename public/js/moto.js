// =================================================================================================
//                      INICIALIZACIÓN ÚNICA
// =================================================================================================
$(document).ready(function(){
    listar();           // Carga la tabla de motos
    obtenerClientes();  // Carga los selects de clientes en los modales
    $('#modal').modal();
    $('#modalEditar').modal();
});

// =================================================================================================
//                      OBTENER CLIENTES PARA LOS SELECTS
// =================================================================================================
function obtenerClientes() {
    $.ajax({
        url: 'app/controllers/cliente.php', 
        type: 'POST',
        data: { action: 'listar' }, 
        dataType: 'json',
    })
    .done(function(response) {
        if (response.success) {
            let options = '<option value="">-- Seleccione un Cliente --</option>';
            
            // CORRECCIÓN AQUÍ: Apuntamos con precisión milimétrica a la estructura de tu controlador
            let listaClientes = response.data.datos;

            if (listaClientes && listaClientes.length > 0) {
                $.each(listaClientes, function(index, cliente) {
                    options += `<option value="${cliente.id}">V-${cliente.cedula} - ${cliente.nombre} ${cliente.apellido}</option>`;
                });
            } else {
                options = '<option value="">No hay clientes registrados</option>';
            }
            
            // Inyectamos las opciones en ambos selectores del HTML
            $('#id_cliente').html(options);
            $('#id_clienteEditar').html(options);

        } else {
            $('#id_cliente').html('<option value="">Error al cargar clientes</option>');
            $('#id_clienteEditar').html('<option value="">Error al cargar clientes</option>');
        }
    });
}

// =================================================================================================
//                                  LISTAR MOTOS
// =================================================================================================
function listar(){
    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json',
    })
    .done(function(data) {
        console.log(data);

        if (data.success) {
            let html = '';

            $.each(data.data.datos, function(index, val) {
                html += `
                  <tr>
                    <td> ${val.id}</td>
                    <td>V-${val.id_cliente}</td>
                    <td> ${val.placa}</td>
                    <td> ${val.marca}</td>
                    <td> ${val.modelo}</td>
                    <td> ${val.color}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn bg-deep-orange btn-circle waves-effect waves-circle waves-float boton-update" id="${val.id}">
                                <i class="material-icons">mode_edit</i>
                            </button>
                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float boton-borrar" id="${val.id}">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                      </td>
                  </tr>
                `;
            });

            $('table tbody').html(html);

        } else {
            console.log(data);
            alert(data.msj);
        }
    });
}

// =================================================================================================
//                                  CREAR MOTO
// =================================================================================================
$('#guardar').click(function() {
    crear();
});

function crear() {
    var placa = $('#placa').val();
    var marca = $('#marca').val();
    var modelo = $('#modelo').val();
    var color = $('#color').val();
    var id_cliente = $('#id_cliente').val(); // Captura el ID numérico del select

    // Validación de seguridad para que no intente guardar si no han seleccionado un dueño
   // if (id_cliente === "" || id_cliente === null) {
     //   alert("Por favor, seleccione el dueño de la moto antes de guardar.");
       // return false;
   // }
//alert("El JavaScript leyó este ID de cliente: '" + id_cliente + "'");
    // ==========================================

    if (id_cliente === "" || id_cliente === null) {
        alert("Por favor, seleccione el dueño de la moto antes de guardar.");
        return false;
    }
    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'crear',
            placa: placa,
            marca: marca,
            modelo: modelo,
            color: color,
            id_cliente: id_cliente
        },
    })
    .done(function(data) {
        if (data.success == true) {
            listar();
            $('#cerrar').click();
            
            // Limpieza de campos
            $('#placa').val("");
            $('#marca').val("");
            $('#modelo').val("");
            $('#color').val("");
            $('#id_cliente').val("");

            alert('Su registro ha sido guardado con éxito');
        } else {
            alert(data.msj);
        }
    });
}

// =================================================================================================
//                                  MODIFICAR MOTO (CONSULTAR)
// =================================================================================================
$("body").on("click","button.boton-update",function(){
    var id = $(this).attr("id");

    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'consultar',
            id: id
        },
    })
    .done(function(data) {
        console.log(data.data.datos);

        if (data.success == true) {
            $('#idMoto').val(data.data.datos[0].id);
            $('#placaEditar').val(data.data.datos[0].placa);
            $('#marcaEditar').val(data.data.datos[0].marca);
            $('#modeloEditar').val(data.data.datos[0].modelo);
            $('#colorEditar').val(data.data.datos[0].color);
            
            // AGREGADO: Carga el dueño actual de la moto en el selector del modal editar
            $('#id_clienteEditar').val(data.data.datos[0].id_cliente);

            $('#abrirModalEditar').click();
        } else {
            alert(data.msj);
        }
    });
});

$('#editar').click(function() {
    editar();
});

function editar() {
    var id = $('#idMoto').val();
    var placa = $('#placaEditar').val();
    var marca = $('#marcaEditar').val();
    var modelo = $('#modeloEditar').val();
    var color = $('#colorEditar').val();
    var id_cliente = $('#id_clienteEditar').val(); // Captura el ID modificado del dueño

    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'editar',
            id: id,
            placa: placa,
            marca: marca,
            modelo: modelo,
            color: color,
            id_cliente: id_cliente // <-- MANDAR AL CONTROLADOR DE PHP PARA EL UPDATE
        },
    })
    .done(function(data) {
        if (data.success == true) {
            listar();
            $('#cerrarEditar').click();
            alert('Su registro ha sido actualizado con éxito');
        } else {
            alert(data.msj);
        }
    });
}

// =================================================================================================
//                                  ELIMINAR MOTO
// =================================================================================================
$("body").on("click","button.boton-borrar",function(){
    var id = $(this).attr("id");
    let resultado = confirm("¿Estás seguro de eliminar esta moto?");

    if (resultado) {
        eliminar(id);
    } else {
        alert("Operación cancelada.");
    }
});

function eliminar(id) {
    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'eliminar',
            id: id
        },
    })
    .done(function(data) { // CORRECCIÓN: Cambiado $.done por .done
        if (data.success) {
            listar();
            alert('Moto eliminada');
        } else {
            alert(data.msj);
        }
    });
}