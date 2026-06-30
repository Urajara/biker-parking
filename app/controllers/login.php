<?php

    // Forzar el encendido de errores para ver si algo falla internamente
    define('DEBUG', true);
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    require_once '../core/BaseController.php';
    require_once '../models/login.php';

    class LoginAjaxController extends BaseController {

        public function ejecutar($action, $data) {
            $method = lcfirst($action);

            if (method_exists($this, $method)) {
                return $this->$method($data);
            } else {
                return $this->jsonResponse(['success' => false, 'message' => 'Acción no reconocida'], 404);
            }
        }

        protected function iniciarSesion($data) {

            if (!isset($data["usuario"]) || !isset($data["password"])) {
                return $this->jsonResponse(['success' => false, 'error' => 'Faltan credenciales'], 400);
            }

            $login = new loginModel();
            $login->setloginuser($data["usuario"]);
            $login->setpassword($data["password"]);
            $user = $login->IniciarSesion();

            // Extraemos los datos del primer registro (si es que existe)
            $datosUsuario = $user['datos'][0] ?? null;

            // 1. PRIMER FILTRO: Si $datosUsuario es null, significa que la cédula no está en la base de datos
            if (!$datosUsuario) {
                return $this->jsonResponse([
                    'success' => false,
                    'error' => 'El número de cédula no existe'
                ]);
            }

            // 2. SEGUNDO FILTRO: ¿La contraseña es correcta?
            if ($datosUsuario['password'] !== $data['password']) {
                return $this->jsonResponse([
                    'success' => false,
                    'error' => 'Contraseña incorrecta'
                ]);
            }

            // 3. TERCER FILTRO: Estado del usuario
            switch ($datosUsuario['estatus']) {
                case '1':
                    return $this->jsonResponse(['success' => false, 'error' => 'Usuario inactivo']);
                case '2':
                    return $this->jsonResponse(['success' => false, 'error' => 'Usuario bloqueado']);
                case '0':
                default:
                    break;
            }    

            // 4. FLUJO DE ÉXITO: Guardamos en sesión usando la estructura de tu BaseController
$this->startSession();

            $_SESSION['id']       = $datosUsuario['id'] ?? '';
            $_SESSION['cedula']   = $datosUsuario['cedula'];
            $_SESSION['nombre']   = $datosUsuario['nombre'] ?? ''; 
            $_SESSION['apellido'] = $datosUsuario['apellido'] ?? ''; 
            $_SESSION['session']  = true; 
            $_SESSION['roles']    = $datosUsuario['roles'] ?? ''; 
            $_SESSION['estatus']  = $datosUsuario['estatus'];
            $_SESSION['password'] = $datosUsuario['password']; 

            // Mandamos al index pasándole la acción para que EnlacesController la capture
            return $this->jsonResponse([
                'success' => true, 
                'message' => 'Usuario activo',
                'session' => true,        
                'url'     => '/templateSoftware/index.php?action=home' 
            ]);
        }
    }

    if (isset($_POST['action'])) {
        $controller = new LoginAjaxController();
        $controller->ejecutar($_POST['action'], $_POST);
    }
?>