<?php

require_once '../core/BaseController.php';
require_once '../models/banco.php';

$action = $_POST['action'] ?? '';
$model = new BancoModel();
$response = ['success' => false, 'data' => ['datos' => []], 'msj' => ''];

if ($action == 'listar') {
    try {
        $datos = $model->listarBancos();
        $response['success'] = true;
        $response['data']['datos'] = $datos;
    } catch (Exception $e) {
        $response['msj'] = 'Error al cargar los bancos: ' . $e->getMessage();
    }
    echo json_encode($response);
    exit;
}
?>