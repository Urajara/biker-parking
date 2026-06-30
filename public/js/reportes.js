$(document).ready(function(){
    obtenerTotalesDiarios();
    obtenerMotosPorZona();
});

function obtenerTotalesDiarios(){
    $.ajax({
        url: 'app/controllers/reportes.php',
        type: 'POST',
        data: {action: 'obtenerTotalesDiarios'},
        dataType: 'json',
    })
    .done(function(response) {
        if (response.success) {
            let datos = response.datos[0] ? response.datos[0] : response.datos;

            $('#lbl_total_motos').text(datos.total_motos || 0);
            
            let ganancias = parseFloat(datos.ganancia_total) || 0.00;
            $('#lbl_ganancia_total').text(ganancias.toFixed(2) + " $");
            
            let tasa = parseFloat(datos.tasa_dia) || 0.00;
            $('#lbl_tasa_dia').text(tasa.toFixed(2) + " Bs");
        } else {
            alert(response.msj || "Error al cargar los totales de la caja.");
        }
    })
    .fail(function(jqXHR) {
        console.error("Error crítico en Totales: ", jqXHR.responseText);
    });
}

function obtenerMotosPorZona(){
    $.ajax({
        url: 'app/controllers/reportes.php',
        type: 'POST',
        data: {action: 'obtenerMotosPorZona'},
        dataType: 'json'
    })
    .done(function(response) {
        if(response.success) {
            let html = '';
            let listaZonas = response.datos.datos ? response.datos.datos : response.datos;

            if(listaZonas && listaZonas.length > 0) {
                $.each(listaZonas, function(index, val) {
                    let zonaNombre = val.nombre_zona ? val.nombre_zona : "Zona Sin Nombre";
                    let cantidadMotos = val.total_motos || 0;

                    html += `
                        <tr>
                            <td><strong>${zonaNombre}</strong></td>
                            <td><span class="badge bg-red" style="font-size: 13px; padding: 5px 10px;">${cantidadMotos} Motos</span></td>
                        </tr>
                    `;
                });
            } else {
                html = `
                    <tr>
                        <td colspan="2" class="text-center" style="color: #888;">No hay zonas registradas en el sistema.</td>
                    </tr>
                `;
            }

            $('#tablaZonas').html(html);
        } else {
            alert(response.msj || "Error al listar el reporte por zonas.");
        }
    })
    .fail(function(jqXHR) {
        console.error("Error crítico en Zonas: ", jqXHR.responseText);
    });
}