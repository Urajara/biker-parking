<?php
require_once '../core/BaseController.php';
require_once '../models/usuarios.php'; // Carga el modelo limpio

// Capturamos la acción enviada por AJAX
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Instanciamos el objeto del modelo globalmente para procesar la acción correspondiente
$usuarioM = new usuariosModel();

switch ($action) {
    // ==========================================
    // NUEVO CASO: Procesar Inicio de Sesión
    // ==========================================
    case 'login':
        // Agregamos trim() para descartar espacios invisibles al inicio o final
        $cedula = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
        $password_ingresada = isset($_POST['password']) ? trim($_POST['password']) : '';

        if (empty($cedula) || empty($password_ingresada)) {
            echo json_encode(array('success' => false, 'msj' => 'Por favor, complete todos los campos.'));
            break;
        }

        // 1. Seteamos la cédula en el modelo para buscar al usuario
        $usuarioM->setCedula($cedula);
        $resLogin = $usuarioM->loginPorCedula();

        if ($resLogin['success']) {
            $userBD = $resLogin['usuario'];

            // 2. Verificamos si el usuario está activo (Estatus = 1)
            if ($userBD['estatus'] == 1) {

                // 3. Comparamos el texto plano contra el hash Bcrypt
                if (password_verify($password_ingresada, $userBD['password'])) {
                    
                    // Iniciamos la sesión si todo es correcto
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    
                    $_SESSION['id_usuario'] = $userBD['id'];
                    $_SESSION['cedula']     = $userBD['cedula'];
                    $_SESSION['nombre']     = $userBD['nombre'];
                    $_SESSION['apellido']   = $userBD['apellido'];
                    $_SESSION['id_rol']     = $userBD['id_rol'];

                    echo json_encode(array('success' => true, 'msj' => '¡Acceso concedido! Redireccionando...'));
                } else {
                    // ========================================================
                    // CONDICIONAL DE DIAGNÓSTICO (TEMPORAL)
                    // ========================================================
                    echo json_encode(array(
                        'success' => false, 
                        'msj' => "CONTRASENIA INCORRECTA. [Recibida en Formulario: '" . $password_ingresada . "'] [Hash en Base de Datos: '" . $userBD['password'] . "']"
                    ));
                }

            } else {
                echo json_encode(array('success' => false, 'msj' => 'Este usuario se encuentra inactivo.'));
            }
        } else {
            echo json_encode($resLogin);
        }
        break;

    case 'listar':
        $res = $usuarioM->listar();
        echo json_encode($res);
        break;

    case 'guardar':
        // Seteamos los datos con trim() para evitar guardar espacios accidentales
        $usuarioM->setCedula(isset($_POST['cedula']) ? trim($_POST['cedula']) : '');
        $usuarioM->setNombre(isset($_POST['nombre']) ? trim($_POST['nombre']) : '');
        $usuarioM->setApellido(isset($_POST['apellido']) ? trim($_POST['apellido']) : '');
        $usuarioM->setPassword(isset($_POST['password']) ? trim($_POST['password']) : '');
        $usuarioM->setId_rol(isset($_POST['id_rol']) ? $_POST['id_rol'] : '');
        $usuarioM->setEstatus(isset($_POST['estatus']) ? $_POST['estatus'] : 1);

        $res = $usuarioM->crear();
        echo json_encode($res);
        break;

    case 'consultar':
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $usuarioM->setId($id);
        $res = $usuarioM->consultar();
        echo json_encode($res);
        break;

    case 'editar':
        $usuarioM->setId(isset($_POST['id']) ? $_POST['id'] : 0);
        $usuarioM->setCedula(isset($_POST['cedula']) ? trim($_POST['cedula']) : '');
        $usuarioM->setNombre(isset($_POST['nombre']) ? trim($_POST['nombre']) : '');
        $usuarioM->setApellido(isset($_POST['apellido']) ? trim($_POST['apellido']) : '');
        $usuarioM->setPassword(isset($_POST['password']) ? trim($_POST['password']) : '');
        $usuarioM->setId_rol(isset($_POST['id_rol']) ? $_POST['id_rol'] : '');
        $usuarioM->setEstatus(isset($_POST['estatus']) ? $_POST['estatus'] : 1);

        $res = $usuarioM->editar();
        echo json_encode($res);
        break;

    case 'eliminar':
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $usuarioM->setId($id);
        $res = $usuarioM->eliminar();
        echo json_encode($res);
        break;

    default:
        echo json_encode(array('success' => false, 'msj' => 'Acción no válida o no especificada.'));
        break;
}
?>