$(document).ready(function(){
    listar();
});

// -------------------------------------------------------------------------------------------------
//              Listar Pagos Realizados
//--------------------------------------------------------------------------------------------------
function listar(){
    $.ajax({
        url: 'app/controllers/pago.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json',
    })
    .done(function(response) {
        console.log(response);

        if (response.success) {
            let html = '';

            // 'response.data.datos' viene estructurado desde tu BaseController y Modelo
            $.each(response.data.datos, function(index, val) {
                html += `
                  <tr>
                    <td>${val.id}</td>
                    <td>#${val.id_ticket}</td>
                    <td>${val.nombre_forma}</td>
                    <td>${val.nombre_banco ? val.nombre_banco : 'N/A'}</td>
                    <td>$${val.monto_dolares}</td>
                    <td>${val.monto_final_pagado} Bs</td>
                    <td>${val.referencia}</td>
                    <td>${val.fecha_pago}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn bg-deep-orange btn-circle waves-effect waves-circle waves-float boton-update-pago" id="${val.id}">
                                <i class="material-icons">mode_edit</i>
                            </button>
                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float boton-borrar-pago" id="${val.id}">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </td>
                  </tr>
                `;
            });

            // Asumiremos que la tabla de historial de pagos tendrá el id o clase correspondiente
            $('#tablaPagos tbody').html(html);
        } else {
            console.log(response);
            alert(response.msj || "Error al listar los pagos.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//              Crear / Registrar Pago
//--------------------------------------------------------------------------------------------------
function crear() {
    // Captura de datos desde el formulario unificado (IDs alineados al MER)
    var id_ticket          = $('#id_ticket').val();
    var id_forma_pago      = $('#id_forma_pago').val();
    var id_banco           = $('#id_banco').val();
    var id_tasa            = $('#id_tasa').val(); // Tasa activa que buscaremos internamente
    var monto_dolares      = $('#monto_dolares').val();
    var monto_final_pagado = $('#monto_final_pagado').val();
    var referencia         = $('#referencia').val();

    // Validación de campos obligatorios
    if(!id_ticket || !id_forma_pago || !id_tasa || !monto_dolares || !monto_final_pagado) {
        alert("Por favor, procese el ticket y complete los campos obligatorios del cobro.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/pago.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'crear',
            id_ticket: id_ticket,
            id_forma_pago: id_forma_pago,
            id_banco: id_banco,
            id_tasa: id_tasa,
            monto_dolares: monto_dolares,
            monto_final_pagado: monto_final_pagado,
            referencia: referencia
        },
    })
    .done(function(response) {
        if (response.success == true) {
            listar();
            
            // Limpieza del formulario de cobro
            $('#id_ticket').val("");
            $('#id_forma_pago').val("");
            $('#id_banco').val("");
            $('#monto_dolares').val("");
            $('#monto_final_pagado').val("");
            $('#referencia').val("");
            
            alert('El pago ha sido procesado y registrado con éxito.');
            
            // Aquí más adelante podremos agregar la función para actualizar la vista de tickets activos
        } else {
            alert(response.msj || "Error al procesar el pago.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//              Modificar (Consultar para editar)
//--------------------------------------------------------------------------------------------------
$("body").on("click", "button.boton-update-pago", function(){
    var id = $(this).attr("id");

    $.ajax({
        url: 'app/controllers/pago.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'consultar',
            id: id
        },
    })
    .done(function(response) {
        if (response.success == true) {
            // Se cargan los datos en el modal de edición de pagos si se requiere
            $('#idPagoEditar').val(response.data.datos[0].id);
            $('#id_ticketEditar').val(response.data.datos[0].id_ticket);
            $('#id_forma_pagoEditar').val(response.data.datos[0].id_forma_pago);
            $('#id_bancoEditar').val(response.data.datos[0].id_banco);
            $('#id_tasaEditar').val(response.data.datos[0].id_tasa);
            $('#monto_dolaresEditar').val(response.data.datos[0].monto_dolares);
            $('#monto_final_pagadoEditar').val(response.data.datos[0].monto_final_pagado);
            $('#referenciaEditar').val(response.data.datos[0].referencia);
            
            $('#modalEditarPago').modal('show');
        } else {
            alert(response.msj || "Error al consultar el registro.");
        }
    });
});

function editar() {
    var id                 = $('#idPagoEditar').val();
    var id_ticket          = $('#id_ticketEditar').val();
    var id_forma_pago      = $('#id_forma_pagoEditar').val();
    var id_banco           = $('#id_bancoEditar').val();
    var id_tasa            = $('#id_tasaEditar').val();
    var monto_dolares      = $('#monto_dolaresEditar').val();
    var monto_final_pagado = $('#monto_final_pagadoEditar').val();
    var referencia         = $('#referenciaEditar').val();

    $.ajax({
        url: 'app/controllers/pago.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'editar',
            id: id,
            id_ticket: id_ticket,
            id_forma_pago: id_forma_pago,
            id_banco: id_banco,
            id_tasa: id_tasa,
            monto_dolares: monto_dolares,
            monto_final_pagado: monto_final_pagado,
            referencia: referencia
        },
    })
    .done(function(response) {
        if (response.success == true) {
            listar();
            $('#modalEditarPago').modal('hide');
            alert('El registro de pago fue actualizado.');
        } else {
            alert(response.msj || "Error al actualizar el pago.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//              Eliminar Pago
//--------------------------------------------------------------------------------------------------
$("body").on("click", "button.boton-borrar-pago", function(){
    var id = $(this).attr("id");
    let resultado = confirm("¿Estás seguro de eliminar este registro de pago? Esto no modificará el estado actual del ticket.");

    if (resultado) {
        eliminar(id);
    }
});

function eliminar(id) {
    $.ajax({
        url: 'app/controllers/pago.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'eliminar',
            id: id
        }
    })
    .done(function(response) {
        if (response.success) {
            listar();
            alert('Registro de pago eliminado.');
        } else {
            alert(response.msj || "No se pudo eliminar el registro.");
        }
    });
}