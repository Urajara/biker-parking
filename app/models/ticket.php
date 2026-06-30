<?php

require_once '../../config/conex.php';

class ticketModel extends Conexion {
    // Atributos de la tabla ticket según tu MER
    private $id;
    private $id_vehiculo;
    private $id_usuario;
    private $id_zona;
    private $fecha_entrada;
    private $hora_entrada;
    private $estatus;
    
    // GETTERS Y SETTERS
    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }
    
    public function setId_vehiculo($id_vehiculo){ $this->id_vehiculo = $id_vehiculo; }
    public function getId_vehiculo(){ return $this->id_vehiculo; }
    
    public function setId_usuario($id_usuario){ $this->id_usuario = $id_usuario; }
    public function getId_usuario(){ return $this->id_usuario; }
    
    public function setId_zona($id_zona){ $this->id_zona = $id_zona; }
    public function getId_zona(){ return $this->id_zona; }
    
    public function setFecha_entrada($fecha_entrada){ $this->fecha_entrada = $fecha_entrada; }
    public function getFecha_entrada(){ return $this->fecha_entrada; }
    
    public function setHora_entrada($hora_entrada){ $this->hora_entrada = $hora_entrada; }
    public function getHora_entrada(){ return $this->hora_entrada; }
    
    public function setEstatus($estatus){ $this->estatus = $estatus; }
    public function getEstatus(){ return $this->estatus; }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO LISTAR (Trae los datos legibles de la moto, usuario y zona usando INNER JOIN)
    // ---------------------------------------------------------------------------------------------
    public function listar(){
        try {
            $sql = "SELECT 
                        t.id, 
                        t.fecha_entrada, 
                        t.hora_entrada, 
                        t.estatus,
                        v.placa, 
                        v.marca, 
                        v.modelo,
                        u.nombre AS nombre_usuario,
                        z.nombre_zona
                    FROM ticket t
                    INNER JOIN vehiculo v ON t.id_vehiculo = v.id
                    INNER JOIN usuarios u ON t.id_usuario = u.id
                    INNER JOIN zonas z ON t.id_zona = z.id_zona
                    ORDER BY t.id DESC";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = array('success' => true, 'datos' => $data);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO CONSULTAR (Busca un ticket específico, vital para el proceso de cobro)
    // ---------------------------------------------------------------------------------------------
    public function consultar(){
        try {
            $sql = "SELECT 
                        t.id, 
                        t.fecha_entrada, 
                        t.hora_entrada, 
                        t.estatus,
                        t.id_zona,
                        v.placa, 
                        v.marca, 
                        v.modelo,
                        z.nombre_zona,
                        z.descuento_porcentaje
                    FROM ticket t
                    INNER JOIN vehiculo v ON t.id_vehiculo = v.id
                    INNER JOIN zonas z ON t.id_zona = z.id_zona
                    WHERE t.id = :id";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = array('success' => true, 'datos' => $data);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO CREAR (Registra la entrada de un vehículo)
    // ---------------------------------------------------------------------------------------------
    public function crear(){
        try {
            $sql = "INSERT INTO ticket (id_vehiculo, id_usuario, id_zona, fecha_entrada, hora_entrada, estatus) 
                    VALUES (:id_vehiculo, :id_usuario, :id_zona, :fecha_entrada, :hora_entrada, :estatus)";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            
            $stmt->bindparam(":id_vehiculo", $this->id_vehiculo, PDO::PARAM_INT);
            $stmt->bindparam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
            $stmt->bindparam(":id_zona", $this->id_zona, PDO::PARAM_INT);
            $stmt->bindparam(":fecha_entrada", $this->fecha_entrada, PDO::PARAM_STR);
            $stmt->bindparam(":hora_entrada", $this->hora_entrada, PDO::PARAM_STR);
            $stmt->bindparam(":estatus", $this->estatus, PDO::PARAM_STR);

            $stmt->execute();
            $result = array('success' => true);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO EDITAR (Permite modificar datos generales del ticket)
    // ---------------------------------------------------------------------------------------------
    public function editar(){
        try {
            $sql = "UPDATE ticket SET 
                        id_vehiculo = :id_vehiculo, 
                        id_usuario = :id_usuario, 
                        id_zona = :id_zona, 
                        fecha_entrada = :fecha_entrada, 
                        hora_entrada = :hora_entrada, 
                        estatus = :estatus 
                    WHERE id = :id";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            
            $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindparam(":id_vehiculo", $this->id_vehiculo, PDO::PARAM_INT);
            $stmt->bindparam(":id_usuario", $this->id_usuario, PDO::PARAM_INT);
            $stmt->bindparam(":id_zona", $this->id_zona, PDO::PARAM_INT);
            $stmt->bindparam(":fecha_entrada", $this->fecha_entrada, PDO::PARAM_STR);
            $stmt->bindparam(":hora_entrada", $this->hora_entrada, PDO::PARAM_STR);
            $stmt->bindparam(":estatus", $this->estatus, PDO::PARAM_STR);

            $stmt->execute();
            $result = array('success' => true);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO ACTUALIZAR ESTATUS (Exclusivo para cambiar estado a 'Pagado' desde la pasarela)
    // ---------------------------------------------------------------------------------------------
    public function actualizarEstatus(){
        try {
            $sql = "UPDATE ticket SET estatus = :estatus WHERE id = :id";
            
            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            
            $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindparam(":estatus", $this->estatus, PDO::PARAM_STR);
            
            $stmt->execute();
            $result = array('success' => true);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO ELIMINAR
    // ---------------------------------------------------------------------------------------------
    public function eliminar(){
        try {
            $sql = "DELETE FROM ticket WHERE id = :id";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);

            $stmt->execute();
            $result = array('success' => true);
        } catch (Exception $e) {
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }
}
?>