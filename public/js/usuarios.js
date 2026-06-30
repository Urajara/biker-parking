$(document).ready(function() {
    // Cargar los selectores dinámicos al iniciar la página
    cargarRoles();
    cargarEstatus();
    listarUsuarios(); // Muestra los datos de la base de datos de inmediato al entrar

    // Evento Click para el botón de Registrar Usuario (Guardar Nuevo)
    $('#guardarUsuario').on('click', function(e) {
        e.preventDefault(); 
        guardar();
    });

    // !!! CORREGIDO: Ahora escucha al ID correcto '#editarUsuario' de tu modal.php para guardar los cambios !!!
    $('#editarUsuario').on('click', function(e) {
        e.preventDefault();
        editarUsuario();
    });
});

// -------------------------------------------------------------------------------------------------
//              1. CARGAR ROLES DINÁMICAMENTE DESDE LA BASE DE DATOS
// -------------------------------------------------------------------------------------------------
function cargarRoles() {
    $.ajax({
        url: 'app/controllers/roles.php',
        type: 'POST',
        data: { action: 'listar' },
        dataType: 'json',
    })
    .done(function(data) {
        if (data.success) {
            let opciones = '<option value="">-- Seleccione el Rol del Trabajador --</option>';
            
            $.each(data.data.datos, function(index, val) {
                opciones += `<option value="${val.id_rol}">${val.nombre_rol}</option>`;
            });

            // Inyectamos las opciones en los selectores de Registrar y Editar
            $('#idRolUsuario').html(opciones);
            $('#idRolUsuarioEditar').html(opciones);

            // Refrescamos los selectores para aplicar estilos de Material Design
            if ($.isFunction($.fn.selectpicker)) {
                $('#idRolUsuario').selectpicker('refresh');
                $('#idRolUsuarioEditar').selectpicker('refresh');
            }
        } else {
            console.error("Error al cargar roles: ", data.msj);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error crítico en la petición de roles:", textStatus, errorThrown);
    });
}

// -------------------------------------------------------------------------------------------------
//              2. CARGAR OPCIONES DE ESTATUS DINÁMICAMENTE (1 y 0)
// -------------------------------------------------------------------------------------------------
function cargarEstatus() {
    let opciones = `
        <option value="1">Activo / Permitido</option>
        <option value="0">Inactivo / Bloqueado</option>
    `;
    
    // Inyectamos las opciones numéricas en los selectores correspondientes
    $('#estatusUsuario').html(opciones);
    $('#estatusUsuarioEditar').html(opciones);

    // Refrescamos los selectores para aplicar estilos de Material Design
    if ($.isFunction($.fn.selectpicker)) {
        $('#estatusUsuario').selectpicker('refresh');
        $('#estatusUsuarioEditar').selectpicker('refresh');
    }
}

// -------------------------------------------------------------------------------------------------
//              3. ACCIÓN: LISTAR USUARIOS EN LA TABLA HTML
// -------------------------------------------------------------------------------------------------
function listarUsuarios() {
    $.ajax({
        url: 'app/controllers/usuarios.php',
        type: 'POST',
        data: { action: 'listar' },
        dataType: 'json'
    })
    .done(function(res) {
        console.log("Usuarios cargados para la tabla:", res);
        
        if (res.success) {
            let filas = '';
            
            if (res.datos && res.datos.length > 0) {
                $.each(res.datos, function(index, val) {
                    // Configuración visual elegante de los estados
                    let badgeEstatus = val.estatus == 1 
                        ? '<span class="badge bg-success text-white" style="background-color: #28a745; padding: 5px 10px; border-radius: 4px;">Activo</span>' 
                        : '<span class="badge bg-danger text-white" style="background-color: #dc3545; padding: 5px 10px; border-radius: 4px;">Inactivo</span>';

                    filas += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${val.cedula}</td>
                            <td>${val.nombre} ${val.apellido}</td>
                            <td>${val.nombre_rol ? val.nombre_rol : 'Sin Rol'}</td>
                            <td>${badgeEstatus}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" onclick="consultarUsuario(${val.id})" style="background-color: #ffc107; border: none; padding: 4px 8px; margin-right: 5px; color: #000; border-radius: 4px; font-weight: bold;">Editar</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="eliminarUsuario(${val.id})" style="background-color: #dc3545; border: none; padding: 4px 8px; color: #fff; border-radius: 4px; font-weight: bold;">Borrar</button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                filas = '<tr><td colspan="6" class="text-center text-muted">No hay usuarios registrados en el sistema.</td></tr>';
            }

            // Inyecta las filas dentro del tbody con ID tablaUsuarios
            $('#tablaUsuarios').html(filas);
        } else {
            console.error("Error al procesar el listado:", res.msj);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error crítico al listar los usuarios:", textStatus, errorThrown);
    });
}

// -------------------------------------------------------------------------------------------------
//              4. ACCIÓN: GUARDAR NUEVO USUARIO
// -------------------------------------------------------------------------------------------------
function guardar() {
    let datos = {
        action: 'guardar',
        cedula: $('#cedulaUsuario').val().trim(),
        password: $('#passwordUsuario').val().trim(),
        nombre: $('#nombreUsuario').val().trim(),
        apellido: $('#apellidoUsuario').val().trim(),
        id_rol: $('#idRolUsuario').val(),
        estatus: $('#estatusUsuario').val()
    };

    if (datos.cedula === "" || datos.password === "" || datos.nombre === "" || datos.apellido === "" || datos.id_rol === "") {
        alert("Por favor, rellene todos los campos obligatorios del formulario.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/usuarios.php', 
        type: 'POST',
        data: datos,
        dataType: 'json'
    })
    .done(function(res) {
        if (res.success) {
            alert("¡Usuario guardado con éxito en el sistema!");
            
            // Ocultamos el modal y limpiamos el formulario
            $('#modalUsuario').modal('hide');
            $('#formularioUsuario')[0].reset();
            
            // Refrescamos la tabla automáticamente
            listarUsuarios(); 
        } else {
            alert("Error al guardar el usuario: " + res.msj);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error crítico en la petición AJAX al guardar:", textStatus, errorThrown);
        alert("Ocurrió un error de comunicación con el servidor al registrar.");
    });
}

// -------------------------------------------------------------------------------------------------
//              5. ACCIÓN: CONSULTAR DATOS DE UN USUARIO PARA EDITAR
// -------------------------------------------------------------------------------------------------
function consultarUsuario(id) {
    $.ajax({
        url: 'app/controllers/usuarios.php', 
        type: 'POST',
        data: { action: 'consultar', id: id },
        dataType: 'json'
    })
    .done(function(res) {
        console.log("Datos del usuario consultado:", res);
        if (res.success && res.datos.length > 0) {
            let u = res.datos[0];
            
            // Rellenamos las cajas de texto del modal de edición
            $('#idUsuarioEditar').val(u.id);
            $('#cedulaUsuarioEditar').val(u.cedula);
            $('#nombreUsuarioEditar').val(u.nombre);
            $('#apellidoUsuarioEditar').val(u.apellido);
            $('#passwordUsuarioEditar').val(''); // Se deja vacío por seguridad
            $('#idRolUsuarioEditar').val(u.id_rol);
            $('#estatusUsuarioEditar').val(u.estatus);

            // Refrescamos los selectores estilizados de Bootstrap/Material
            if ($.isFunction($.fn.selectpicker)) {
                $('#idRolUsuarioEditar').selectpicker('refresh');
                $('#estatusUsuarioEditar').selectpicker('refresh');
            }

            // Abre el modal de edición usando el ID correcto de tu HTML
            $('#modalUsuarioEditar').modal('show');
        } else {
            alert("No se pudieron cargar los datos del usuario.");
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error al consultar:", textStatus, errorThrown);
        alert("Error de comunicación al consultar el registro para editar.");
    });
}

// -------------------------------------------------------------------------------------------------
//              6. ACCIÓN: ENVIAR ACTUALIZACIÓN DEL USUARIO MODIFICADO
// -------------------------------------------------------------------------------------------------
function editarUsuario() {
    let datos = {
        action: 'editar',
        id: $('#idUsuarioEditar').val(),
        cedula: $('#cedulaUsuarioEditar').val().trim(),
        nombre: $('#nombreUsuarioEditar').val().trim(),
        apellido: $('#apellidoUsuarioEditar').val().trim(),
        password: $('#passwordUsuarioEditar').val().trim(), 
        id_rol: $('#idRolUsuarioEditar').val(),
        estatus: $('#estatusUsuarioEditar').val()
    };

    if (datos.cedula === "" || datos.nombre === "" || datos.apellido === "" || datos.id_rol === "") {
        alert("Por favor, rellene todos los campos obligatorios.");
        return false;
    }

    $.ajax({
        url: 'app/controllers/usuarios.php', 
        type: 'POST',
        data: datos,
        dataType: 'json'
    })
    .done(function(res) {
        if (res.success) {
            alert("¡Usuario modificado con éxito!");
            $('#modalUsuarioEditar').modal('hide'); // Oculta el modal de cambios
            listarUsuarios(); // Refresca dinámicamente tu tabla limpia
        } else {
            alert("Error al actualizar el usuario: " + res.msj);
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error al editar:", textStatus, errorThrown);
        alert("Ocurrió un error de comunicación con el servidor. Revisa la consola.");
    });
}

// -------------------------------------------------------------------------------------------------
//              7. ACCIÓN: ELIMINAR REGISTRO DE USUARIO
// -------------------------------------------------------------------------------------------------
function eliminarUsuario(id) {
    if (confirm("¿Estás completamente seguro de eliminar este usuario del sistema?")) {
        $.ajax({
            url: 'app/controllers/usuarios.php', 
            type: 'POST',
            data: { action: 'eliminar', id: id },
            dataType: 'json'
        })
        .done(function(res) {
            if (res.success) {
                alert("Usuario eliminado correctamente.");
                listarUsuarios(); // Refresca el listado al instante
            } else {
                alert("No se pudo eliminar el registro.");
            }
        })
        .fail(function() {
            alert("Error de conexión al intentar eliminar.");
        });
    }
}