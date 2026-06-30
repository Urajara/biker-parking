<?php
require_once '../../config/conex.php'; 

class ModuloModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listarModulos() {
        // Consultamos la tabla modulo según tu MER
        $sql = "SELECT id_modulo, nombre_modulo FROM modulo";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>