<?php
require_once '../core/BaseController.php';
require_once '../models/forma_pago.php';

$action = $_POST['action'] ?? '';
$model = new FormaPagoModel();
$response = ['success' => false, 'data' => ['datos' => []], 'msj' => ''];

if ($action == 'listar') {
    try {
        $datos = $model->listarFormas();
        $response['success'] = true;
        $response['data']['datos'] = $datos;
    } catch (Exception $e) {
        $response['msj'] = 'Error al cargar las formas de pago: ' . $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
?>