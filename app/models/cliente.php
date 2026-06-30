<?php
     //si funciono no lo toques
	require_once '../../config/conex.php';
	// require_once 'logs.php';

	class clientesModel extends Conexion{
        private $id;
		private $cedula;
		private $nombre;
		private $apellido;
		private $telefono;
		
		public function setId($id){ $this->id = $id; }
		public function getId(){ return $this->id; }
		public function setCedula($cedula){ $this->cedula = $cedula; }
		public function getCedula(){ return $this->cedula; }
		public function setNombre($nombre){ $this->nombre = $nombre; }
		public function getNombre(){ return $this->nombre; }
		public function setApellido($apellido){ $this->apellido = $apellido; }
		public function getApellido(){ return $this->apellido; }
		public function setTelefono($telefono){ $this->telefono = $telefono; }
		public function getTelefono(){ return $this->telefono; }



		public function listar(){

			try {

				$sql = ("SELECT * FROM clientes");

				$stmt = parent::conectar()->prepare($sql);

				$x = $stmt->execute();

				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$result = array('success' => true, 'datos' => $data );

			} catch ( Exception $e ) {

				// var_dump($e->getMessage());
				// exit();
				$result = array('success' => false, 'error' => 1 );
			}

			return $result;

			$conex = null;

		} #Fin Funcion

		public function consultar(){

			try {

				$sql = ("SELECT * FROM clientes WHERE id = :id");

				$stmt = parent::conectar()->prepare($sql);
				$stmt->bindparam(":id", $this->id, PDO::PARAM_STR);

				$x = $stmt->execute();

				$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$result = array('success' => true, 'datos' => $data );

			} catch ( Exception $e ) {

				// var_dump($e->getMessage());
				// exit();
				$result = array('success' => false, 'error' => 1 );
			}

			return $result;

			$conex = null;

		} #Fin Funcion

		public function crear(){

			try {

				$sql = ("INSERT INTO clientes (cedula,nombre,apellido,telefono ) VALUES (:cedula,:nombre,:apellido,:telefono)");

				$stmt = parent::conectar()->prepare($sql);
				
				$stmt->bindparam(":cedula", $this->cedula, PDO::PARAM_STR);
				$stmt->bindparam(":nombre", $this->nombre, PDO::PARAM_STR);
				$stmt->bindparam(":apellido", $this->apellido, PDO::PARAM_STR);
				$stmt->bindparam(":telefono", $this->telefono, PDO::PARAM_STR);
				

				$x = $stmt->execute();

				$result = array('success' => true);

			} catch ( Exception $e ) {

				var_dump($e->getMessage());
				exit();
				$result = array('success' => false, 'error' => 1 );
			}

			return $result;

			$conex = null;

		} #Fin Funcion

		public function editar(){

			try {

				$sql = ("UPDATE clientes SET cedula =:cedula,nombre=:nombre,apellido=:apellido,telefono= :telefono WHERE id = :id");

				$stmt = parent::conectar()->prepare($sql);
				$stmt->bindparam(":id", $this->id, PDO::PARAM_STR);
				
                $stmt->bindparam(":cedula", $this->cedula, PDO::PARAM_STR);
				$stmt->bindparam(":nombre", $this->nombre, PDO::PARAM_STR);
				$stmt->bindparam(":apellido", $this->apellido, PDO::PARAM_STR);
				$stmt->bindparam(":telefono", $this->telefono, PDO::PARAM_STR);
				

				$x = $stmt->execute();

				$result = array('success' => true);

			} catch ( Exception $e ) {

				// var_dump($e->getMessage());
				// exit();
				$result = array('success' => false, 'error' => 1 );
			}

			return $result;

			$conex = null;

		} #Fin Funcion

		public function eliminar(){

			try {

				$sql = ("DELETE FROM clientes WHERE id = :id");

				$stmt = parent::conectar()->prepare($sql);
				$stmt->bindparam(":id", $this->id, PDO::PARAM_INT);

				$x = $stmt->execute();

				$result = array('success' => true);

			} catch ( Exception $e ) {

				// var_dump($e->getMessage());
				// exit();
				$result = array('success' => false, 'error' => 1 );
			}

			return $result;

			$conex = null;

		} #Fin Funcion
	} #Fin clase
?>