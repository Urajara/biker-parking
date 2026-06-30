<?php

    // define('DEBUG', true);
    // error_reporting(E_ALL);
    // ini_set('display_errors', DEBUG ? 'On' : 'Off');

    require_once '../core/BaseController.php';
    require_once '../models/moto.php';

    class MotoAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function listar($data) {

            $motos = new motosModel();
            $user = $motos->listar();

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

            $motos = new motosModel();
            $motos->setPlaca($data["placa"]);
            $motos->setMarca($data["marca"]);
            $motos->setModelo($data["modelo"]);
            $motos->setColor($data["color"]);
            $id_cliente = isset($data["id_cliente"]) ? (int)$data["id_cliente"] : 0;
            $motos->setId_cliente($id_cliente);
            
    
            $user = $motos->crear();

         //var_dump( $user['success'] );
         //exit();

            if ( $user['success'] ) {

                return $this->jsonResponse([
                    'success' => true
                ]);
            } else {

                return $this->jsonResponse(['success' => false, 'error' => 3, 'msj' => 'Error Al Guardar la Informacion']);
            }
        }

        protected function consultar($data) {

            $motos = new motosModel();
            $motos->setId($data["id"]);
            $user = $motos->consultar();

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

            $motos = new motosModel();
            $motos->setId($data["id"]);
            $motos->setPlaca($data["placa"]);
            $motos->setMarca($data["marca"]);
            $motos->setModelo($data["modelo"]);
            $motos->setColor($data["color"]);
            $user = $motos->editar();

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

            $motos = new motosModel();
            $motos->setId($data["id"]);
            $user = $motos->eliminar();

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
        $controller = new MotoAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>