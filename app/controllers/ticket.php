<?php

    require_once '../core/BaseController.php';
    require_once '../models/ticket.php'; // Tu archivo de modelo de tickets

    class TicketAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function listar($data) {
            $ticket = new ticketModel();
            $res = $ticket->listar();

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
            $ticket = new ticketModel();
            
            // Asignamos los campos obligatorios para la apertura del ticket según tu MER
            $ticket->setId_vehiculo($data["id_vehiculo"]);
            $ticket->setId_usuario($data["id_usuario"]); // Operador logueado en el sistema
            $ticket->setId_zona($data["id_zona"]);
            $ticket->setFecha_entrada($data["fecha_entrada"]);
            $ticket->setHora_entrada($data["hora_entrada"]);
            
            // Al abrirse un ticket, por defecto arranca con estatus 'Activo'
            $ticket->setEstatus(!empty($data["estatus"]) ? $data["estatus"] : 'Activo');
            
            $res = $ticket->crear();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Información']);
            }
        }

        protected function consultar($data) {
            $ticket = new ticketModel();
            $ticket->setId($data["id"]);
            $res = $ticket->consultar();

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
            $ticket = new ticketModel();
            $ticket->setId($data["id"]);
            $ticket->setId_vehiculo($data["id_vehiculo"]);
            $ticket->setId_usuario($data["id_usuario"]);
            $ticket->setId_zona($data["id_zona"]);
            $ticket->setFecha_entrada($data["fecha_entrada"]);
            $ticket->setHora_entrada($data["hora_entrada"]);
            $ticket->setEstatus($data["estatus"]); // Útil si se requiere cambiar de 'Activo' a 'Pagado' manualmente
            
            $res = $ticket->editar();

            if ( $res['success'] ) {
                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {
                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Información']);
            }
        }

        protected function eliminar($data) {
            $ticket = new ticketModel();
            $ticket->setId($data["id"]);
            $res = $ticket->eliminar();

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
        $controller = new TicketAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>