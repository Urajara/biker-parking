<?php

class BaseController {
    
    /**
     * Responde con un JSON estandarizado.
     */
    protected function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    /**
     * Redirección simple.
     */
    protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    /**
     * Inicia la sesión de forma segura si no está iniciada.
     */
    protected function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
