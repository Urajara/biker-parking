<?php
require_once '../core/BaseController.php';
require_once '../models/usuarios.php'; // Carga el modelo limpio que definimos arriba

// Capturamos la acción enviada por AJAX
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Instanciamos el objeto del modelo globalmente para procesar la acción correspondiente
$usuarioM = new usuariosModel();

switch ($action) {
    case 'listar':
        $res = $usuarioM->listar();
        echo json_encode($res);
        break;

    case 'guardar':
        // Seteamos los datos enviados desde el formulario con seguridad
        $usuarioM->setCedula(isset($_POST['cedula']) ? $_POST['cedula'] : '');
        $usuarioM->setNombre(isset($_POST['nombre']) ? $_POST['nombre'] : '');
        $usuarioM->setApellido(isset($_POST['apellido']) ? $_POST['apellido'] : '');
        $usuarioM->setPassword(isset($_POST['password']) ? $_POST['password'] : '');
        $usuarioM->setId_rol(isset($_POST['id_rol']) ? $_POST['id_rol'] : '');
        $usuarioM->setEstatus(isset($_POST['estatus']) ? $_POST['estatus'] : 1);

        // Ejecutamos la consulta de inserción
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
        $usuarioM->setCedula(isset($_POST['cedula']) ? $_POST['cedula'] : '');
        $usuarioM->setNombre(isset($_POST['nombre']) ? $_POST['nombre'] : '');
        $usuarioM->setApellido(isset($_POST['apellido']) ? $_POST['apellido'] : '');
        $usuarioM->setPassword(isset($_POST['password']) ? $_POST['password'] : '');
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