<?php

    require_once 'app/core/BaseController.php';
    require_once 'app/core/Router.php';

    class EnlacesController extends BaseController {

        public function run() {
            $action = isset($_GET["action"]) ? $_GET["action"] : "index";
            
            # Valida si existe una session activa, caso contrario redirige al login
            // if ($action !== "index" && !isset($_SESSION["usuario"])) {
            //     $this->redirect("index.php?action=index");
            // }

            require_once "app/template/template.php";
        }

        public function enlacesControl() {
            $this->startSession();
            
            $action = isset($_GET["action"]) ? $_GET["action"] : "index";
            $userRole = isset($_SESSION["codrol"]) ? $_SESSION["codrol"] : null;

            $router = new Router();
            $result = $router->resolve($action, $userRole);

            # indica si que requiere menú
            if ($result['menu']) {
                include 'app/views/page/menu.php';
            }

            // Incluimos la vista
            include $result['file'];
        }
    }
?>
