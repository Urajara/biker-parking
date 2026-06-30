<?php

    // define('DEBUG', true);
    // error_reporting(E_ALL);
    // ini_set('display_errors', DEBUG ? 'On' : 'Off');

    require_once '../core/BaseController.php';
    require_once '../models/reportes.php';

    class ReportesAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        // 1. MÉTODO: OBTENER LOS TOTALES GENERALES DE LA CAJA DIARIA
        protected function obtenerTotalesDiarios($data) {
            $reportes = new reportesModel();
            $res = $reportes->obtenerTotalesDiarios();

            // Valida el éxito de la consulta compuesta (Motos + Tasa de la BD)
            if ($res && $res['success']) {
                return $this->jsonResponse([
                    'success' => true,
                    'datos'   => $res['datos']
                ]);
            } else {
                return $this->jsonResponse([
                    'success' => false, 
                    'error'   => 3, 
                    'msj'     => isset($res['msj']) ? $res['msj'] : 'Error al obtener los totales del día'
                ]);
            }
        }

        // 2. MÉTODO: OBTENER EL DESGLOSE COMPLETO POR ZONAS
        protected function obtenerMotosPorZona($data) {
            $reportes = new reportesModel();
            $res = $reportes->obtenerMotosPorZona();

            // Responde de forma exitosa siempre que el modelo no tenga excepciones SQL
            if ($res && $res['success']) {
                return $this->jsonResponse([
                    'success' => true,
                    'datos'   => $res['datos']
                ]);
            } else {
                return $this->jsonResponse([
                    'success' => false, 
                    'error'   => 3, 
                    'msj'     => isset($res['msj']) ? $res['msj'] : 'Error al obtener el reporte por zonas'
                ]);
            }
        }
    }

    // Despachador de peticiones AJAX
    if (isset($_POST['action'])) {
        $controller = new ReportesAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>