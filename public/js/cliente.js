// =================================================================================================
//                      VARIABLES GLOBALES DEL MÓDULO
// =================================================================================================
// Almacena la lista de clientes que responde el servidor para buscar al instante sin recargar
let listaClientesMemoria = []; 

$(document).ready(function(){

    listar();
    // CORRECCIÓN: Ahora sí activamos la precarga cuando abre el módulo
    precargarClientesEnMemoria(); 
    
})
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

// -------------------------------------------------------------------------------------------------
//              listar
//--------------------------------------------------------------------------------------------------


function listar(){

    $.ajax({
        url: 'app/controllers/cliente.php',
        type: 'POST',
        data: {action: 'listar'},
        dataType: 'json',
    })
    .done(function(data) {

        console.log( data )

        if ( data.success ) {

            let html = '';

                $.each(data.data.datos, function(index, val) {

                    html += `
                      <tr>
                        <td> ${val.id}</td>
                        <td>${val.cedula}</td>
                        <td> ${val.nombre}</td>
                        <td> ${val.apellido}</td>
                        <td> ${val.telefono}</td>
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
            console.log( data )
            alert( data.msj )
        }
    })
}

// -------------------------------------------------------------------------------------------------
//              Crear
//--------------------------------------------------------------------------------------------------

$('#guardar').click(function() {

    crear();
})

function crear(event) {

    var cedula = $('#cedula').val()
    var nombre = $('#nombre').val()
    var apellido= $('#apellido').val()
    var telefono = $('#telefono').val()
    


    $.ajax({
        url: 'app/controllers/cliente.php',
        type: 'POST',
        dataType: 'json',
        data: {action: 'crear',
                cedula:cedula,
                nombre: nombre,
                apellido:apellido,
                telefono:telefono,
        },
    })
    .done(function(data) {

        if (data.success == true) {

            listar();
            $('#cerrar').click();
            $('#cedula').val("");
            $('#nombre').val("");
            $('#apellido').val("");
            $('#telefono').val("");

            


            alert( 'Su registro ha sido guardado con exito' )
        } else {

            alert( data.msj )
        }
    })
}

// -------------------------------------------------------------------------------------------------
//              Modificar
//--------------------------------------------------------------------------------------------------


$("body").on("click","button.boton-update",function(){

    var id = $(this).attr("id")

    $.ajax({
        url: 'app/controllers/cliente.php',
        type: 'POST',
        dataType: 'json',
        data: {action: 'consultar',
                id: id,},
    })
    .done(function(data) {

        console.log( data.data.datos )

        if (data.success == true) {

            $('#idCliente').val( data.data.datos[0].id )
            $('#cedulaEditar').val( data.data.datos[0].cedula )
            $('#nombreEditar').val( data.data.datos[0].nombre )
            $('#apellidoEditar').val( data.data.datos[0].apellido )
            $('#telefonoEditar').val( data.data.datos[0].telefono)
            
            

            $('#abrirModalEditar').click();
            // $('#modalEditar').modal('open');
             //const myModalAlternative = new bootstrap.Modal('#modalEditar', options)

        } else {

            alert( data.msj )
        }
    })
})


$('#editar').click(function() {

    editar();

})

function editar() {

    var id = $('#idCliente').val()
    var cedula = $('#cedulaEditar').val()
    var nombre = $('#nombreEditar').val()
    var apellido = $('#apellidoEditar').val()
    var telefono = $('#telefonoEditar').val()
    
    
    
            

    $.ajax({
        url: 'app/controllers/cliente.php',
        type: 'POST',
        dataType: 'json',
        data: {action: 'editar',
                id:id,
                cedula:cedula,
                nombre:nombre,
                apellido:apellido,
                telefono:telefono
            },
    })
    .done(function(data) {

        if (data.success == true) {

            listar();
            $('#cerrarEditar').click();

            alert( 'Su registro ha sido actualizado con exito' )

        } else {

            alert( data.msj )
        }


    })
}
// -------------------------------------------------------------------------------------------------
//              Eliminar
//--------------------------------------------------------------------------------------------------

$("body").on("click","button.boton-borrar",function(){

    var id = $(this).attr("id")

    let resultado = confirm("¿Estás seguro de eliminar este cliente?");

    if (resultado) {

        eliminar(id)
    } else {

        alert("Operación cancelada.");
    }
})

function eliminar(id) {

    $.ajax({
        url: 'app/controllers/cliente.php',
        type: 'POST',
        dataType: 'json',
        data: {action: 'eliminar',
                id: id},
    })
    // CORRECCIÓN: Cambiado $.done por .done para evitar errores de sintaxis
    .done(function(data) {

            if ( data.success ) {

                listar();

                alert( 'Cliente eliminado' )
            } else {

                alert( data.msj )
            }
    })
}

// =================================================================================================
//   NUEVO: FUNCIÓN DE FILTRADO EN TIEMPO REAL PARA EL BUSCADOR DE CLIENTES
// =================================================================================================
$(document).on('keyup', '#buscarEnTablaClientes', function() {
    var query = $(this).val().toLowerCase().trim();
    
    // Filtramos las filas directamente en el DOM basado en el texto escrito
    $("table tbody tr").filter(function() {
        var contenidoFila = $(this).text().toLowerCase();
        $(this).toggle(contenidoFila.indexOf(query) > -1);
    });
});