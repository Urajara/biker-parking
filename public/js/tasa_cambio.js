

$(document).ready(function(){
    listar();
    // Inicialización correcta de modales si es necesario
    $('#modal').modal({ show: false });
    $('#modalEditar').modal({ show: false });
});

// =================================================================================================
//   FUNCIÓN: FILTRAR LA TABLA DE TASAS DE CAMBIO POR FECHA (BÚSQUEDA EN TIEMPO REAL)
// =================================================================================================
$(document).on('keyup', '#buscarEnTablaTasas', function() {
    var query = $(this).val().toLowerCase().trim();
    
    // Filtramos las filas (tr) de la tabla de tasas de cambio
    $("table tbody tr").filter(function() {
        var contenidoFila = $(this).text().toLowerCase();
        
        // Muestra u oculta la fila según coincida con los caracteres de la fecha
        $(this).toggle(contenidoFila.indexOf(query) > -1);
    });
});

// -------------------------------------------------------------------------------------------------
//              listar
//--------------------------------------------------------------------------------------------------
function listar(){
    $.ajax({
        url: 'app/controllers/tasa_cambio.php',
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
                    <td>${val.id}</td>
                    <td>${val.valor_bs}</td>
                    <td>${val.fecha_tasa}</td>
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

// -------------------------------------------------------------------------------------------------
//              Crear
//--------------------------------------------------------------------------------------------------
$('#guardar').click(function() {
    crear();
});

function crear() {
    // CORREGIDO: Se cambiaron los nombres antiguos (cedula/nombre) por los correctos correspondientes a los inputs
    var valor_bs = $('#valor_bs').val();
    var fecha_tasa = $('#fecha_tasa').val();

    // Validación simple antes de enviar
    if(valor_bs === "" || fecha_tasa === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/tasa_cambio.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'crear',
            valor_bs: valor_bs,
            fecha_tasa: fecha_tasa
        },
    })
    .done(function(data) {
        if (data.success == true) {
            listar();
            $('#cerrar').click(); // Cierra el modal
            $('#valor_bs').val("");
            $('#fecha_tasa').val("");
            
            alert('Su registro ha sido guardado con éxito');
        } else {
            alert(data.msj);
        }
    });
}

// -------------------------------------------------------------------------------------------------
//              Modificar (Consultar y Cargar datos)
//--------------------------------------------------------------------------------------------------
$("body").on("click", "button.boton-update", function(){
    var id = $(this).attr("id");

    $.ajax({
        url: 'app/controllers/tasa_cambio.php',
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
            $('#idTasa_cambio').val(data.data.datos[0].id);
            $('#valor_bsEditar').val(data.data.datos[0].valor_bs);
            $('#fecha_tasaEditar').val(data.data.datos[0].fecha_tasa);
            
            // CORREGIDO: Forma estándar y limpia de abrir el modal en Bootstrap
            $('#modalEditar').modal('show');
        } else {
            alert(data.msj);
        }
    });
});

$('#editar').click(function() {
    editar();
});

function editar() {
    var id = $('#idTasa_cambio').val();
    var valor_bs = $('#valor_bsEditar').val();
    var fecha_tasa = $('#fecha_tasaEditar').val();

    $.ajax({
        url: 'app/controllers/tasa_cambio.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'editar',
            id: id,
            valor_bs: valor_bs,
            fecha_tasa: fecha_tasa
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
// -------------------------------------------------------------------------------------------------
//				Eliminar
//--------------------------------------------------------------------------------------------------

$("body").on("click","button.boton-borrar",function(){

    var id = $(this).attr("id")

	let resultado = confirm("¿Estás seguro de eliminar esta tasa de cambio?");

	if (resultado) {

		eliminar(id)
	} else {

		alert("Operación cancelada.");
	}
})

function eliminar(id) {

	$.ajax({
		url: 'app/controllers/tasa_cambio.php',
		type: 'POST',
		dataType: 'json',
		data: {action: 'eliminar',
				id: id},
	})
	$.done(function(data) {

			if ( data.success ) {

				listar();

				alert( 'tasa de cambio  eliminada' )
			} else {

				alert( data.msj )
			}
	})
}