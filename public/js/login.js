$(document).ready(function () {

});

//__________________________________ Click Boton Login __________________________________________________________
$("#password").keyup(function (event) {
    if (event.keyCode == 13) {
        ingresar();
    }
});

$("#Ingresar").click(function (event) {
    // Si tu botón "Ingresar" es un <button type="submit"> dentro de un <form>,
    // necesitas esta línea para evitar que recargue la página de golpe:
    event.preventDefault(); 
    ingresar();
});

$('#mostrar2').on('change', function (event) { //mostrar contraseña 
    // Si el checkbox esta "checkeado"
    if ($('#mostrar2').is(':checked')) {
        // Convertimos el input de contraseña a texto.
        $('#password').get(0).type = 'text';
    } else {
        // Lo convertimos a contraseña.
        $('#password').get(0).type = 'password';
    }
});
// Fin Function Ingresar ==========================================================================

//-----------------------------------funcion ingresar ------------------------------------------
function ingresar() {

    // CORREGIDO: Usamos minúscula para que coincida exactamente con tu controlador PHP
    var action = 'iniciarSesion'; 
    var usuario = $('#usuario').val().trim();
    var password = $('#password').val().trim();

    if (usuario.length > 0 && password.length > 0) {

        var datos = new FormData();
        datos.append('action', action);
        datos.append("usuario", usuario);
        datos.append('password', password);

        // Mantenemos la ruta exacta que ya tenías configurada
        var urlDestino = '/templateSoftware/app/controllers/login.php'; 
        
        $.ajax({
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            url: urlDestino,
            data: datos,
            dataType: "json",
            beforeSend: function () { 
                // Aquí podrías deshabilitar el botón para evitar doble clic si quisieras
            },
            success: function (data) {
                if (data.success == true) {
                    alert('Bienvenido Al Sistema');
                    
                    window.location.replace(data.url);
                } else {
                    // OPTIMIZADO: Ahora muestra el error real (Cédula no existe, bloqueado, etc.)
                    alert(data.error);
                }
            },
            error: function (xhr, status, error) {
                // VITAL: Si PHP llega a fallar catastróficamente, esto te avisará en pantalla
                alert('Ocurrió un error en el servidor. Revisa la consola (F12).');
                console.error(xhr.responseText);
            }
        });
    } else {
        alert('Llene Los Campos');
    }
}
//-----------------------------------Fin funcion ingresar ------------------------------------------