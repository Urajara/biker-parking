<?php

    require_once '../../config/conex.php';

    class motosModel extends Conexion {
        private $id;
        private $placa;
        private $marca;
        private $modelo;
        private $color;
        private $id_cliente;
        
        public function setId($id){ $this->id = $id; }
        public function getId(){ return $this->id; }
        
        public function setPlaca($placa){ $this->placa = $placa; }
        public function getPlaca(){ return $this->placa; }
        
        public function setMarca($marca){ $this->marca = $marca; }
        public function getMarca(){ return $this->marca; }
        
        public function setModelo($modelo){ $this->modelo = $modelo; }
        public function getModelo(){ return $this->modelo; }

        public function setColor($color){ $this->color = $color; }
        public function getColor(){ return $this->color; }

        public function setId_cliente($id_cliente){ $this->id_cliente = $id_cliente; }
        public function getId_cliente(){ return $this->id_cliente; }

        // =========================================================================================
        // LISTAR (Tal como lo tenías, sin clientes.cedula)
        // =========================================================================================
    public function listar(){
            try {
                $db = parent::conectar();
                // AÑADIDO: clientes.cedula a la consulta SELECT
                $sql = "SELECT vehiculo.id, vehiculo.placa, vehiculo.marca, vehiculo.modelo, vehiculo.color, vehiculo.id_cliente, clientes.cedula 
                        FROM vehiculo 
                        INNER JOIN clientes ON clientes.id = vehiculo.id_cliente";

                $stmt = $db->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $result = array('success' => true, 'datos' => $data );
            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }
            return $result;
        }

        // =========================================================================================
        // CONSULTAR
        // =========================================================================================
        public function consultar(){
            try {
                $db = parent::conectar();
                $sql = "SELECT vehiculo.id, vehiculo.placa, vehiculo.marca, vehiculo.modelo, vehiculo.color, vehiculo.id_cliente 
                        FROM vehiculo 
                        INNER JOIN clientes ON clientes.id = vehiculo.id_cliente 
                        WHERE vehiculo.id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $result = array('success' => true, 'datos' => $data );
            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }
            return $result;
        }

        // =========================================================================================
        // CREAR (Conexión fija para asegurar el id_cliente)
        // =========================================================================================
        public function crear(){
            try {
                $db = parent::conectar(); 
                $sql = "INSERT INTO vehiculo (placa, marca, modelo, color, id_cliente) 
                        VALUES (:placa, :marca, :modelo, :color, :id_cliente)";

                $stmt = $db->prepare($sql);
                
                $stmt->bindparam(":placa", $this->placa, PDO::PARAM_STR);
                $stmt->bindparam(":marca", $this->marca, PDO::PARAM_STR);
                $stmt->bindparam(":modelo", $this->modelo, PDO::PARAM_STR);
                $stmt->bindparam(":color", $this->color, PDO::PARAM_STR);
                $stmt->bindparam(":id_cliente", $this->id_cliente, PDO::PARAM_INT);

                $stmt->execute();
                $result = array('success' => true);

            } catch ( Exception $e ) {
                var_dump($e->getMessage());
                exit();
            }
            return $result;
        }

        // =========================================================================================
        // EDITAR (Incluye id_cliente por si se reasigna el dueño)
        // =========================================================================================
        public function editar(){
            try {
                $db = parent::conectar();
                $sql = "UPDATE vehiculo SET 
                            placa = :placa, 
                            marca = :marca, 
                            modelo = :modelo, 
                            color = :color, 
                            id_cliente = :id_cliente 
                        WHERE id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
                $stmt->bindparam(":placa", $this->placa, PDO::PARAM_STR);
                $stmt->bindparam(":marca", $this->marca, PDO::PARAM_STR);
                $stmt->bindparam(":modelo", $this->modelo, PDO::PARAM_STR);
                $stmt->bindparam(":color", $this->color, PDO::PARAM_STR);
                $stmt->bindparam(":id_cliente", $this->id_cliente, PDO::PARAM_INT);

                $stmt->execute();
                $result = array('success' => true);
            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }
            return $result;
        }

        // =========================================================================================
        // ELIMINAR
        // =========================================================================================
        public function eliminar(){
            try {
                $db = parent::conectar();
                $sql = "DELETE FROM vehiculo WHERE id = :id";

                $stmt = $db->prepare($sql);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();

                $result = array('success' => true);
            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }
            return $result;
        }
    }
?>