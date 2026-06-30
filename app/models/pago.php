<?php

require_once '../../config/conex.php';

class pagosModel extends Conexion {
    // Atributos de la tabla pago (id, montos, referencia, fecha)
    private $id;
    private $id_ticket;
    private $id_forma_pago;
    private $id_banco;
    private $id_tasa;
    private $monto_dolares;
    private $monto_final_pagado;
    private $referencia;
    private $fecha_pago;
    
    // GETTERS Y SETTERS
    public function setId($id){ $this->id = $id; }
    public function getId(){ return $this->id; }
    
    public function setId_ticket($id_ticket){ $this->id_ticket = $id_ticket; }
    public function getId_ticket(){ return $this->id_ticket; }
    
    public function setId_forma_pago($id_forma_pago){ $this->id_forma_pago = $id_forma_pago; }
    public function getId_forma_pago(){ return $this->id_forma_pago; }
    
    public function setId_banco($id_banco){ $this->id_banco = $id_banco; }
    public function getId_banco(){ return $this->id_banco; }
    
    public function setId_tasa($id_tasa){ $this->id_tasa = $id_tasa; }
    public function getId_tasa(){ return $this->id_tasa; }
    
    public function setMonto_dolares($monto_dolares){ $this->monto_dolares = $monto_dolares; }
    public function getMonto_dolares(){ return $this->monto_dolares; }
    
    public function setMonto_final_pagado($monto_final_pagado){ $this->monto_final_pagado = $monto_final_pagado; }
    public function getMonto_final_pagado(){ return $this->monto_final_pagado; }
    
    public function setReferencia($referencia){ $this->referencia = $referencia; }
    public function getReferencia(){ return $this->referencia; }
    
    public function setFecha_pago($fecha_pago){ $this->fecha_pago = $fecha_pago; }
    public function getFecha_pago(){ return $this->fecha_pago; }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO LISTAR
    // ---------------------------------------------------------------------------------------------
    public function listar(){
        try {
            $sql = "SELECT 
                        p.id, 
                        p.id_ticket,
                        p.monto_dolares, 
                        p.monto_final_pagado, 
                        p.referencia,
                        p.fecha_pago,
                        b.nombre_banco, 
                        f.nombre_forma, 
                        t.valor_bs
                    FROM pago p
                    INNER JOIN bancos b ON p.id_banco = b.id
                    INNER JOIN forma_pago f ON p.id_forma_pago = f.id
                    INNER JOIN tasa_cambio t ON p.id_tasa = t.id
                    ORDER BY p.id DESC";

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
    //  MÉTODO CONSULTAR
    // ---------------------------------------------------------------------------------------------
    public function consultar(){
        try {
            $sql = "SELECT * FROM pago WHERE id = :id";

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
    //  MÉTODO CREAR (Registra el pago y actualiza el estatus del Ticket de forma segura)
    // ---------------------------------------------------------------------------------------------
    public function crear(){
        try {
            $db = parent::conectar();
            
            // Iniciamos transacción para asegurar que ocurran AMBAS acciones
            $db->beginTransaction();

            // 1. Insertar el pago
            $sqlPago = "INSERT INTO pago (id_ticket, id_forma_pago, id_banco, id_tasa, monto_dolares, monto_final_pagado, referencia) 
                        VALUES (:id_ticket, :id_forma_pago, :id_banco, :id_tasa, :monto_dolares, :monto_final_pagado, :referencia)";

            $stmtPago = $db->prepare($sqlPago);
            
            $stmtPago->bindparam(":id_ticket", $this->id_ticket, PDO::PARAM_INT);
            $stmtPago->bindparam(":id_forma_pago", $this->id_forma_pago, PDO::PARAM_INT);
            $stmtPago->bindparam(":id_banco", $this->id_banco, PDO::PARAM_INT);
            $stmtPago->bindparam(":id_tasa", $this->id_tasa, PDO::PARAM_INT);
            $stmtPago->bindparam(":monto_dolares", $this->monto_dolares, PDO::PARAM_STR);
            $stmtPago->bindparam(":monto_final_pagado", $this->monto_final_pagado, PDO::PARAM_STR);
            $stmtPago->bindparam(":referencia", $this->referencia, PDO::PARAM_STR);
            $stmtPago->execute();

            // 2. MODIFICAR EL ESTATUS DEL TICKET AUTOMÁTICAMENTE
            $sqlTicket = "UPDATE ticket SET estatus = 'Pagado' WHERE id = :id_ticket";
            $stmtTicket = $db->prepare($sqlTicket);
            $stmtTicket->bindparam(":id_ticket", $this->id_ticket, PDO::PARAM_INT);
            $stmtTicket->execute();

            // Confirmamos la transacción completa
            $db->commit();
            $result = array('success' => true);
        } catch (Exception $e) {
            // Si algo falla, deshacemos todo para evitar inconsistencias
            if(isset($db) && $db->inTransaction()) {
                $db->rollBack();
            }
            $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage());
        }
        return $result;
    }

    // ---------------------------------------------------------------------------------------------
    //  MÉTODO EDITAR
    // ---------------------------------------------------------------------------------------------
    public function editar(){
        try {
            $sql = "UPDATE pago SET 
                        id_ticket = :id_ticket,
                        id_forma_pago = :id_forma_pago,
                        id_banco = :id_banco,
                        id_tasa = :id_tasa,
                        monto_dolares = :monto_dolares, 
                        monto_final_pagado = :monto_final_pagado, 
                        referencia = :referencia
                    WHERE id = :id";

            $db = parent::conectar();
            $stmt = $db->prepare($sql);
            
            $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindparam(":id_ticket", $this->id_ticket, PDO::PARAM_INT);
            $stmt->bindparam(":id_forma_pago", $this->id_forma_pago, PDO::PARAM_INT);
            $stmt->bindparam(":id_banco", $this->id_banco, PDO::PARAM_INT);
            $stmt->bindparam(":id_tasa", $this->id_tasa, PDO::PARAM_INT);
            $stmt->bindparam(":monto_dolares", $this->monto_dolares, PDO::PARAM_STR);
            $stmt->bindparam(":monto_final_pagado", $this->monto_final_pagado, PDO::PARAM_STR);
            $stmt->bindparam(":referencia", $this->referencia, PDO::PARAM_STR);

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
            $sql = "DELETE FROM pago WHERE id = :id";

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