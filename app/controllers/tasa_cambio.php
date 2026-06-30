<?php

    // define('DEBUG', true);
    // error_reporting(E_ALL);
    // ini_set('display_errors', DEBUG ? 'On' : 'Off');

    require_once '../core/BaseController.php';
    require_once '../models/tasa_cambio.php';

    class Tasa_cambioAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function listar($data) {

            $tasa_cambio = new tasa_cambioModel();
            $user = $tasa_cambio->listar();

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

            $tasa_cambio = new tasa_cambioModel();
            $tasa_cambio->setValor_bs($data["valor_bs"]);
            $tasa_cambio->setFecha_tasa($data["fecha_tasa"]);
            
            $user = $tasa_cambio->crear();

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

            $tasa_cambio = new tasa_cambioModel();
            $tasa_cambio->setId($data["id"]);
            $user = $tasa_cambio->consultar();

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

            $tasa_cambio = new tasa_cambioModel();
            $tasa_cambio->setId($data["id"]);
            $tasa_cambio->setValor_bs($data["valor_bs"]);
            $tasa_cambio->setFecha_tasa($data["fecha_tasa"]);
            $user = $tasa_cambio->editar();

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

            $tasa_cambio = new tasa_cambioModel();
            $tasa_cambio->setId($data["id"]);
            $user = $tasa_cambio->eliminar();

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
        $controller = new Tasa_cambioAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>