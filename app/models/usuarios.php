<?php

    require_once '../../config/conex.php';
    // require_once 'logs.php';

    class usuariosModel extends Conexion{

        private $id;
        private $cedula;
        private $nombre;
        private $apellido;
        private $password;
        private $id_rol; // Agregado para el control de accesos
        private $estatus;

        public function setId($id){ $this->id = $id; }
        public function getId(){ return $this->id; }
        public function setCedula($cedula){ $this->cedula = $cedula; }
        public function getCedula(){ return $this->cedula; }
        public function setNombre($nombre){ $this->nombre = $nombre; }
        public function getNombre(){ return $this->nombre; }
        public function setApellido($apellido){ $this->apellido = $apellido; }
        public function getApellido(){ return $this->apellido; }
        public function setPassword($password){ $this->password = $password; }
        public function getPassword(){ return $this->password; }
        
        // Métodos Getter y Setter para id_rol
        public function setId_rol($id_rol){ $this->id_rol = $id_rol; }
        public function getId_rol(){ return $this->id_rol; }
        
        public function setEstatus($estatus){ $this->estatus = $estatus; }
        public function getEstatus(){ return $this->estatus; }

        public function listar(){
            try {
                // INNER JOIN para traer el nombre del rol a tu tabla de la vista
                $sql = "SELECT u.id, u.cedula, u.nombre, u.apellido, u.id_rol, u.estatus, r.nombre_rol 
                        FROM usuarios u 
                        INNER JOIN roles r ON u.id_rol = r.id_rol 
                        ORDER BY u.id DESC";

                $stmt = parent::conectar()->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $result = array('success' => true, 'datos' => $data );

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
            $conex = null;
        } #Fin Funcion

        public function consultar(){
            try {
                $sql = "SELECT id, cedula, nombre, apellido, id_rol, estatus FROM usuarios WHERE id = :id";

                $stmt = parent::conectar()->prepare($sql);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $result = array('success' => true, 'datos' => $data );

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
            $conex = null;
        } #Fin Funcion

        public function crear(){
            try {
                // Ahora inserta el id_rol y el estatus dinámico que viene del JS
                $sql = "INSERT INTO usuarios (cedula, nombre, apellido, password, id_rol, estatus) 
                        VALUES (:cedula, :nombre, :apellido, :password, :id_rol, :estatus)";

                // Encriptamos la contraseña con BCRYPT por seguridad antes de guardar
                $passwordEncriptada = password_hash($this->password, PASSWORD_BCRYPT);

                $stmt = parent::conectar()->prepare($sql);
                $stmt->bindparam(":cedula", $this->cedula, PDO::PARAM_STR);
                $stmt->bindparam(":nombre", $this->nombre, PDO::PARAM_STR);
                $stmt->bindparam(":apellido", $this->apellido, PDO::PARAM_STR);
                $stmt->bindparam(":password", $passwordEncriptada, PDO::PARAM_STR);
                $stmt->bindparam(":id_rol", $this->id_rol, PDO::PARAM_INT);
                $stmt->bindparam(":estatus", $this->estatus, PDO::PARAM_INT);

                $stmt->execute();
                $result = array('success' => true);

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
            $conex = null;
        } #Fin Funcion

        public function editar(){
            try {
                // Si el campo password viene vacío, no lo actualiza para no borrar la contraseña actual
                if (!empty($this->password)) {
                    $sql = "UPDATE usuarios SET cedula=:cedula, nombre=:nombre, apellido = :apellido, password = :password, id_rol = :id_rol, estatus = :estatus WHERE id = :id";
                    $passwordEncriptada = password_hash($this->password, PASSWORD_BCRYPT);
                } else {
                    $sql = "UPDATE usuarios SET cedula=:cedula, nombre=:nombre, apellido = :apellido, id_rol = :id_rol, estatus = :estatus WHERE id = :id";
                }

                $stmt = parent::conectar()->prepare($sql);
                $stmt->bindparam(":cedula", $this->cedula, PDO::PARAM_STR);
                $stmt->bindparam(":nombre", $this->nombre, PDO::PARAM_STR);
                $stmt->bindparam(":apellido", $this->apellido, PDO::PARAM_STR);
                $stmt->bindparam(":id_rol", $this->id_rol, PDO::PARAM_INT);
                $stmt->bindparam(":estatus", $this->estatus, PDO::PARAM_INT);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);

                if (!empty($this->password)) {
                    $stmt->bindparam(":password", $passwordEncriptada, PDO::PARAM_STR);
                }

                $stmt->execute();
                $result = array('success' => true);

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
            $conex = null;
        } #Fin Funcion

        public function eliminar(){
            try {
                $sql = "DELETE FROM usuarios WHERE id = :id";

                $stmt = parent::conectar()->prepare($sql);
                $stmt->bindparam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();

                $result = array('success' => true);

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
            $conex = null;
        } #Fin Funcion
    } #Fin clase
?>