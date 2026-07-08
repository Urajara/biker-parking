// =================================================================================================
//                      VARIABLES GLOBALES DEL MÓDULO
// =================================================================================================
// Almacena la lista de clientes que responde el servidor para buscar al instante sin recargar
let listaClientesMemoria = []; 

// =================================================================================================
//                      INICIALIZACIÓN ÚNICA
// =================================================================================================
$(document).ready(function(){
    listar();                      // Carga la tabla de motos
    precargarClientesEnMemoria();  // Guarda los clientes en memoria para el buscador profesional
});

// =================================================================================================
//                      PRECARGAR CLIENTES EN MEMORIA (Buscador Profesional)
// =================================================================================================
function precargarClientesEnMemoria() {
    $.ajax({
        url: 'app/controllers/cliente.php', 
        type: 'POST',
        data: { action: 'listar' }, 
        dataType: 'json',
    })
    .done(function(response) {
        if (response.success) {
            // Guardamos el arreglo original de clientes en nuestra variable global
            listaClientesMemoria = response.data.datos || [];
        } else {
            console.error("Error al precargar los clientes en memoria.");
        }
    });
}

// =================================================================================================
//                                   LISTAR MOTOS
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
                   <td>V-${val.cedula}</td>
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
//                                   CREAR MOTO
// =================================================================================================
$('#guardar').click(function() {
    crear();
});

function crear() {
    var placa = $('#placa').val();
    var marca = $('#marca').val();
    var modelo = $('#modelo').val();
    var color = $('#color').val();
    
    // IMPORTANTE: Sigue capturando el valor de #id_cliente (que ahora será tu campo oculto)
    var id_cliente = $('#id_cliente').val(); 

    if (id_cliente === "" || id_cliente === null) {
        alert("Por favor, busque y seleccione el dueño de la moto antes de guardar.");
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
            
            // Limpieza del buscador profesional
            $('#id_cliente').val("");
            $('#buscarCedulaDueno').val("");

            alert('Su registro ha sido guardado con éxito');
        } else {
            alert(data.msj);
        }
    });
}

// =================================================================================================
//                                   MODIFICAR MOTO (CONSULTAR)
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
            
            // Para el modal de edición mantendremos el select clásico por compatibilidad inmediata
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
    var id_cliente = $('#id_clienteEditar').val(); 

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
            id_cliente: id_cliente 
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
//                                   ELIMINAR MOTO
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
    .done(function(data) { 
        if (data.success) {
            listar();
            alert('Moto eliminada');
        } else {
            alert(data.msj);
        }
    });
}

// =================================================================================================
//       NUEVA FUNCIÓN: EVENTO DE BÚSQUEDA INTERNA DE DUEÑO (MODAL AGREGAR MOTO)
// =================================================================================================
$(document).on('keyup', '#buscarCedulaDueno', function() {
    let criterio = $(this).val().trim().toLowerCase();
    let listaFlotante = $('#sugerenciasClientes');
    
    // Si el buscador está vacío limpiamos el contenedor y el id oculto
    if (criterio === "") {
        listaFlotante.hide().empty();
        $('#id_cliente').val('');
        return;
    }

    let itemsHtml = '';
    let coincidencias = 0;

    // Filtramos los clientes cargados dinámicamente en memoria
    $.each(listaClientesMemoria, function(index, cliente) {
        let cedula = cliente.cedula.toLowerCase();
        
        if (cedula.indexOf(criterio) > -1) {
            coincidencias++;
            itemsHtml += `
                <a href="javascript:void(0);" 
                   class="list-group-item list-group-item-action item-seleccionar-cliente" 
                   data-id="${cliente.id}" 
                   data-visual="V-${cliente.cedula} - ${cliente.nombre} ${cliente.apellido}">
                    👤 V-${cliente.cedula} - ${cliente.nombre} ${cliente.apellido}
                </a>`;
        }
        
        // Máximo 5 sugerencias en pantalla
        if (coincidencias >= 5) return false; 
    });

    if (itemsHtml !== '') {
        listaFlotante.html(itemsHtml).show();
    } else {
        listaFlotante.html('<div class="list-group-item text-muted">No se encontraron registros</div>').show();
        $('#id_cliente').val('');
    }
});

// Asignar el cliente seleccionado de la lista flotante
$(document).on('click', '.item-seleccionar-cliente', function() {
    let idObtenido = $(this).data('id');
    let textoMostrar = $(this).data('visual');

    $('#id_cliente').val(idObtenido);       // Se guarda el ID en el input hidden
    $('#buscarCedulaDueno').val(textoMostrar); // Ponemos el nombre en el input de texto
    $('#sugerenciasClientes').hide().empty(); // Cerramos las opciones flotantes
});

// Ocultar las sugerencias si el usuario da clic fuera del buscador
$(document).click(function(event) {
    if (!$(event.target).closest('#buscarCedulaDueno, #sugerenciasClientes').length) {
        $('#sugerenciasClientes').hide();
    }
});

// =================================================================================================
//       NUEVA FUNCIÓN: FILTRAR LA TABLA PRINCIPAL DE MOTOS (BÚSQUEDA GENERAL)
// =================================================================================================
$(document).on('keyup', '#buscarEnTablaMotos', function() {
    var query = $(this).val().toLowerCase().trim();
    
    $("table tbody tr").filter(function() {
        var contenidoFila = $(this).text().toLowerCase();
        $(this).toggle(contenidoFila.indexOf(query) > -1);
    });
});