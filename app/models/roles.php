<?php
require_once '../../config/conex.php'; 

class RolesModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listarRoles() {
        // Consultamos la tabla roles según tu MER
        $sql = "SELECT id_rol, nombre_rol FROM roles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>