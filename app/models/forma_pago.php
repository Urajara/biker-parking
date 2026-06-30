<?php
require_once '../../config/conex.php';

class FormaPagoModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listarFormas() {
        // CORREGIDO: nombre_forma
        $sql = "SELECT id, nombre_forma FROM forma_pago";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>