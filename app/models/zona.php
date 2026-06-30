<?php
require_once '../../config/conex.php';

class ZonaModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar(); 
    }

    public function listarZonas() {
        // CORREGIDO: Nombres exactos de tu BD
        $sql = "SELECT id_zona, nombre_zona, descuento_porcentaje FROM zonas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>