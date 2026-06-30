<?php

require_once '../core/BaseController.php';
require_once '../models/roles.php';

$action = $_POST['action'] ?? '';
$model = new RolesModel();
$response = ['success' => false, 'data' => ['datos' => []], 'msj' => ''];

if ($action == 'listar') {
    try {
        $datos = $model->listarRoles();
        $response['success'] = true;
        $response['data']['datos'] = $datos;
    } catch (Exception $e) {
        $response['msj'] = 'Error al cargar los roles: ' . $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
?>