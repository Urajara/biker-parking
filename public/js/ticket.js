$(document).ready(function(){
    listarTickets();
    cargarMotosSelect();  // Rellena el select de motos dinámicamente
    cargarZonasSelect();  // Rellena el select de zonas dinámicamente
    cargarBancosSelect();      // <- Agregado para rellenar los bancos al iniciar
    cargarFormasPagoSelect();

    // ESCUCHADOR AGREGADO: Detecta cuando se envía el formulario de cobro
    $("#btnGuardarCobro").on("click", function(e) {
        e.preventDefault();
        registrarPagoTicket();
    });
});

// -------------------------------------------------------------------------------------------------
//               Listar Tickets (Historial de Entradas)
//--------------------------------------------------------------------------------------------------
function listarTickets(){
    $.ajax({
        url: 'app/controllers/ticket.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json',
    })
    .done(function(response) {
        if (response.success) {
            let html = '';

            $.each(response.data.datos, function(index, val) {
                // Definimos un color de etiqueta según el estatus para que sea visualmente cómodo
                let claseEstatus = val.estatus === 'Activo' ? 'badge bg-green' : 'badge bg-blue';
                
                html += `
                  <tr>
                    <td>${val.id}</td>
                    <td><strong>${val.placa}</strong> (${val.marca})</td>
                    <td>${val.nombre_zona}</td>
                    <td>${val.fecha_entrada} a las ${val.hora_entrada}</td>
                    <td><span class="${claseEstatus}">${val.estatus}</span></td>
                    <td>
                        <div class="d-flex gap-2">
                            ${val.estatus === 'Activo' ? `
                                <button type="button" class="btn bg-orange btn-circle waves-effect waves-circle waves-float boton-cobrar-ticket" id="${val.id}" title="Cobrar Salida">
                                    <i class="material-icons">attach_money</i>
                                </button>
                            ` : ''}
                            <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float boton-borrar-ticket" id="${val.id}" title="Eliminar Ticket">
                                <i class="material-icons">delete</i>
                            </button>
                        </div>
                    </td>
                  </tr>
                `;
            });

            // Apunta al ID '#tabla' de la vista unificada
            $('#tabla tbody').html(html);
        } else {
            alert(response.msj || "Error al listar los tickets.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Cargar Moto (Placas) en el Select de Entrada
//--------------------------------------------------------------------------------------------------
function cargarMotosSelect() {
    $.ajax({
        url: 'app/controllers/moto.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json'
    })
    .done(function(response) {
        if(response.success && response.data && response.data.datos) {
            let options = '<option value="">-- Seleccione la Moto (Placa) --</option>';
            $.each(response.data.datos, function(index, val) {
                options += `<option value="${val.id}">${val.placa} - ${val.marca}</option>`;
            });
            $('#id_vehiculo').html(options);
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Cargar Zonas en el Select de Entrada
//--------------------------------------------------------------------------------------------------
function cargarZonasSelect() {
    $.ajax({
        url: 'app/controllers/zona.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json'
    })
    .done(function(response) {
        if(response.success && response.data && response.data.datos) {
            let options = '<option value="">-- Seleccione la Zona de Estacionamiento --</option>';
            $.each(response.data.datos, function(index, val) {
                // CORREGIDO: Ahora mapea id_zona correspondiente al MER
                options += `<option value="${val.id_zona}">${val.nombre_zona}</option>`;
            });
            $('#id_zona').html(options);
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Cargar Bancos en los Selects de Cobro (Crear y Editar)
//--------------------------------------------------------------------------------------------------
function cargarBancosSelect() {
    $.ajax({
        url: 'app/controllers/banco.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json'
    })
    .done(function(response) {
        if(response.success && response.data && response.data.datos) {
            let options = '<option value="">-- Seleccione el Banco (Si Aplica) --</option>';
            $.each(response.data.datos, function(index, val) {
                options += `<option value="${val.id}">${val.nombre_banco}</option>`;
            });
            $('#id_banco').html(options); 
            $('#id_bancoEditar').html(options); 
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Cargar Formas de Pago en los Selects de Cobro (Crear y Editar)
//--------------------------------------------------------------------------------------------------
function cargarFormasPagoSelect() {
    $.ajax({
        url: 'app/controllers/forma_pago.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json'
    })
    .done(function(response) {
        if(response.success && response.data) {
            let options = '<option value="">-- Forma de Pago --</option>';
            let listas = response.data.datos ? response.data.datos : response.data;

            $.each(listas, function(index, val) {
                options += `<option value="${val.id}">${val.nombre_forma}</option>`;
            });
            
            $('#id_forma_pago').html(options); 
            $('#id_forma_pagoEditar').html(options); 
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Registrar Entrada de Vehículo (Crear Ticket)
//--------------------------------------------------------------------------------------------------
function crearTicket() {
    var id_vehiculo   = $('#id_vehiculo').val();
    var id_zona       = $('#id_zona').val();
    
    // CORREGIDO: Si el input de sesión viene vacío o no se encuentra, asigna 1 por defecto (Evita error en BD)
    var id_usuario    = $('#id_usuario_sesion').val() || 1; 
    
    var ahora        = new Date();
    var fecha_entrada = ahora.toISOString().split('T')[0]; 
    var hora_entrada  = ahora.toTimeString().split(' ')[0];  

    if(!id_vehiculo || !id_zona) {
        alert("Por favor, seleccione el vehículo y la zona de estacionamiento.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/ticket.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'crear',
            id_vehiculo: id_vehiculo,
            id_zona: id_zona,
            id_usuario: id_usuario,
            fecha_entrada: fecha_entrada,
            hora_entrada: hora_entrada
        },
    })
    .done(function(response) {
        if (response.success == true) {
            listarTickets();
            
            $('#id_vehiculo').val("").trigger('change'); 
            $('#id_zona').val("");
            $('#modal').modal('hide');
            
            alert('Ticket de Entrada generado con éxito.');
        } else {
            alert(response.msj || "Error al generar el ticket.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Cargar Datos del Ticket en el Formulario de Cobro
//--------------------------------------------------------------------------------------------------
$("body").on("click", "button.boton-cobrar-ticket", function(){
    var id = $(this).attr("id");

    $.ajax({
        url: 'app/controllers/ticket.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'consultar',
            id: id
        },
    })
    .done(function(response) {
        if (response.success == true) {
            let datosTicket = response.data.datos[0];
            
            $('#id_ticket').val(datosTicket.id);
            $('#txt_id_ticket_ver').val(datosTicket.id); 
            $('#txt_placa_cobro').val(datosTicket.placa + " (" + datosTicket.marca + ")");
            $('#txt_entrada_cobro').val(datosTicket.fecha_entrada + " - " + datosTicket.hora_entrada);
            
            calcularMontos(datosTicket.fecha_entrada, datosTicket.hora_entrada);
            
            // Dispara el clic para abrir el modal de facturación de cobro
            $('#abrirModalCobrar').click();
            
        } else {
            alert(response.msj || "Error al consultar el ticket.");
        }
    });
});

// -------------------------------------------------------------------------------------------------
//               Función Matemática para Calcular el Tiempo y Precios
//--------------------------------------------------------------------------------------------------
function calcularMontos(fechaEntrada, horaEntrada) {
    const TARIFA_POR_HORA = 1.00; 
    var valorTasaBs = parseFloat($('#valor_tasa_actual').val()) || 1.00; 

    var entrada = new Date(fechaEntrada + "T" + horaEntrada);
    var ahora   = new Date();

    var diferenciaMs = ahora - entrada;
    var horas = diferenciaMs / (1000 * 60 * 60);

    if (horas < 1) horas = 1; 

    var totalDolares = (horas * TARIFA_POR_HORA).toFixed(2);
    var totalBs      = (totalDolares * valorTasaBs).toFixed(2);

    $('#monto_dolares').val(totalDolares);
    $('#monto_final_pagado').val(totalBs);
}

// -------------------------------------------------------------------------------------------------
//       NUEVA FUNCIÓN: Envía el Cobro al Servidor y Refresca Automáticamente la Tabla
//--------------------------------------------------------------------------------------------------
function registrarPagoTicket() {
    var id_ticket     = $('#id_ticket').val();
    var id_forma_pago = $('#id_forma_pago').val();
    var id_banco      = $('#id_banco').val() || null;
    var id_tasa       = $('#id_tasa_actual').val() || 1; // ID de la tasa en BD
    var monto_usd     = $('#monto_dolares').val();
    var monto_bs      = $('#monto_final_pagado').val();
    var referencia    = $('#referencia').val() || "Efectivo";

    if(!id_forma_pago) {
        alert("Por favor, seleccione la forma de pago.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/pago.php', // Apunta al controlador encargado de los pagos
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'crear',
            id_ticket: id_ticket,
            id_forma_pago: id_forma_pago,
            id_banco: id_banco,
            id_tasa: id_tasa,
            monto_dolares: monto_usd,
            monto_final_pagado: monto_bs,
            referencia: referencia
        }
    })
    .done(function(response) {
        if(response.success) {
            alert('¡Pago registrado con éxito! El ticket ahora está Pagado.');
            
            // Ocultamos el modal de cobro de Bootstrap
            $('#modalCobrar').modal('hide');
            
            // Limpiamos los campos de control del pago
            $('#referencia').val("");
            $('#id_forma_pago').val("");
            
            // REFRESCAR LA TABLA INMEDIATAMENTE
            listarTickets(); 
        } else {
            alert(response.msj || "Error crítico al procesar la transacción de pago.");
        }
    });
}

// -------------------------------------------------------------------------------------------------
//               Eliminar Ticket
//--------------------------------------------------------------------------------------------------
$("body").on("click", "button.boton-borrar-ticket", function(){
    var id = $(this).attr("id");
    let resultado = confirm("¿Estás seguro de eliminar este ticket de entrada? Esto removerá la moto del sistema.");

    if (resultado) {
        $.ajax({
            url: 'app/controllers/ticket.php',
            type: 'POST',
            dataType: 'json',
            data: { action: 'eliminar', id: id }
        })
        .done(function(response) {
            if (response.success) {
                listarTickets();
                alert('Ticket eliminado con éxito.');
            } else {
                alert(response.msj || "No se pudo eliminar el ticket.");
            }
        });
    }
});