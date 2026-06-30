<?php
require_once '../core/BaseController.php';
require_once '../models/zona.php';

$action = $_POST['action'] ?? '';
$model = new ZonaModel();
$response = ['success' => false, 'data' => ['datos' => []], 'msj' => ''];

if ($action == 'listar') {
    try {
        $datos = $model->listarZonas();
        $response['success'] = true;
        $response['data']['datos'] = $datos;
    } catch (Exception $e) {
        $response['msj'] = 'Error al cargar las zonas: ' . $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
?>