<?php
require_once '../../config/conex.php'; 

class PermisoModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listarPermisos() {
        // Consultamos la tabla permisos según tu MER
        $sql = "SELECT id_permiso, id_rol, id_modulo FROM permisos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>