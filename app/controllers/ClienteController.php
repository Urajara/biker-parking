<?php

    // define('DEBUG', true);
	// error_reporting(E_ALL);
	// ini_set('display_errors', DEBUG ? 'On' : 'Off');

    // require_once '../models/clientes.php';

class ClientesController {

    public function ejecutar($accion, $datos) {
        switch ($accion) {
            case 'listar':
                return $this->listar($datos);
            case 'crear':
                return $this->crear($datos);
            case 'editar':
                return $this->editar($datos);
            case 'eliminar':
                return $this->eliminar($datos);
            default:
                return json_encode(['success' => false, 'message' => 'Acción no reconocida']);
        }
    }

    private function listar($datos) {
        
        return json_encode([
            'success' => true, 
            'data' => [] // Aquí irían los resultados
        ]);
    }

    private function crear($datos) {
        
        return json_encode([
            'success' => true, 
            'message' => 'Cliente creado correctamente'
        ]);
    }

    private function editar($datos) {
        
        return json_encode([
            'success' => true, 
            'message' => 'Cliente actualizado'
        ]);
    }

    private function eliminar($datos) {

        return json_encode([
            'success' => true, 
            'message' => 'Cliente eliminado'
        ]);
    }
}

// Se llama directamente al archivo
if (isset($_POST['action'])) {
    $controller = new ClientesController();
    echo $controller->ejecutar($_POST['action'], $_POST);
}
