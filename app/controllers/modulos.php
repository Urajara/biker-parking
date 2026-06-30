<?php

require_once '../core/BaseController.php';
require_once '../models/modulos.php';

$action = $_POST['action'] ?? '';
$model = new ModuloModel();
$response = ['success' => false, 'data' => ['datos' => []], 'msj' => ''];

if ($action == 'listar') {
    try {
        $datos = $model->listarModulos();
        $response['success'] = true;
        $response['data']['datos'] = $datos;
    } catch (Exception $e) {
        $response['msj'] = 'Error al cargar los módulos: ' . $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
?>