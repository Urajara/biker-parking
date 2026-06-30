<?php
require_once '../../config/conex.php'; 

class BancoModel {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function listarBancos() {
        $sql = "SELECT id, nombre_banco FROM bancos";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>