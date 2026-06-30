<?php

    require_once '../core/BaseController.php';
    require_once '../models/pago.php'; // Tu archivo de modelo de pagos

    class PagoAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function listar($data) {
            $pago = new pagosModel();
            $res = $pago->listar();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true,
                    'data' => $res
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Obtener la Información']);
            }
        }

        protected function crear($data) {
            $pago = new pagosModel();
            
            // Mapeamos los datos con los setters correspondientes del modelo ajustado al MER
            $pago->setId_ticket($data["id_ticket"]);
            $pago->setId_forma_pago($data["id_forma_pago"]);
            
            // Si el banco viene vacío (ej. efectivo), mandamos null de manera segura
            $pago->setId_banco(!empty($data["id_banco"]) ? $data["id_banco"] : null);
            
            $pago->setId_tasa($data["id_tasa"]);
            $pago->setMonto_dolares($data["monto_dolares"]);
            $pago->setMonto_final_pagado($data["monto_final_pagado"]);
            
            // Si la referencia está vacía, guardamos N/A por defecto
            $pago->setReferencia(!empty($data["referencia"]) ? $data["referencia"] : 'N/A');
            
            $res = $pago->crear();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Información']);
            }
        }

        protected function consultar($data) {
            $pago = new pagosModel();
            $pago->setId($data["id"]);
            $res = $pago->consultar();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true,
                    'data' => $res
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Obtener la Información']);
            }
        }

        protected function editar($data) {
            $pago = new pagosModel();
            $pago->setId($data["id"]);
            $pago->setId_ticket($data["id_ticket"]);
            $pago->setId_forma_pago($data["id_forma_pago"]);
            $pago->setId_banco(!empty($data["id_banco"]) ? $data["id_banco"] : null);
            $pago->setId_tasa($data["id_tasa"]);
            $pago->setMonto_dolares($data["monto_dolares"]);
            $pago->setMonto_final_pagado($data["monto_final_pagado"]);
            $pago->setReferencia(!empty($data["referencia"]) ? $data["referencia"] : 'N/A');
            
            $res = $pago->editar();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Información']);
            }
        }

        protected function eliminar($data) {
            $pago = new pagosModel();
            $pago->setId($data["id"]);
            $res = $pago->eliminar();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Eliminar la Información']);
            }
        }
    }

    if (isset($_POST['action'])) {
        $controller = new PagoAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>