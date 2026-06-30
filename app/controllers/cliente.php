<?php

    // define('DEBUG', true);
    // error_reporting(E_ALL);
    // ini_set('display_errors', DEBUG ? 'On' : 'Off');

    require_once '../core/BaseController.php';
    require_once '../models/cliente.php';

    class ClienteAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function listar($data) {

            $clientes = new clientesModel();
            $user = $clientes->listar();

            // var_dump( $user['success'] );
            // exit();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true,
                    'data' => $user
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Obtener la Informacion']);
            }
        }

        protected function crear($data) {

            // var_dump( $data );
            // exit;

            $clientes = new clientesModel();
            $clientes->setCedula($data["cedula"]);
            $clientes->setNombre($data["nombre"]);
            $clientes->setApellido($data["apellido"]);
            $clientes->setTelefono($data["telefono"]);
            
    
            $user = $clientes->crear();

            // var_dump( $user['success'] );
            // exit();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Informacion']);
            }
        }

        protected function consultar($data) {

            $clientes = new clientesModel();
            $clientes->setId($data["id"]);
            $user = $clientes->consultar();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true,
                    'data' => $user
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Obtener la Informacion']);
            }
        }

        protected function editar($data) {

            // var_dump( $data );
            // exit;

            $clientes = new clientesModel();
            $clientes->setId($data["id"]);
            $clientes->setCedula($data["cedula"]);
            $clientes->setNombre($data["nombre"]);
            $clientes->setApellido($data["apellido"]);
            $clientes->setTelefono($data["telefono"]);
            $user = $clientes->editar();

            // var_dump( $user['success'] );
            // exit();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Informacion']);
            }
        }

        protected function eliminar($data) {

            // var_dump( $data );
            // exit;

            $clientes = new clientesModel();
            $clientes->setId($data["id"]);
            $user = $clientes->eliminar();

            // var_dump( $user['success'] );
            // exit();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Informacion']);
            }
        }
    }

    if (isset($_POST['action'])) {
        $controller = new ClienteAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>