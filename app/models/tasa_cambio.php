<?php

	require_once '../../config/conex.php';
	// require_once 'logs.php';

	class tasa_cambioModel extends Conexion{
        private $id;
		private $valor_bs;
		private $fecha_tasa;
		
		public function setId($id){ $this->id = $id; }
		public function getId(){ return $this->id; }
		public function setValor_bs($valor_bs){ $this->valor_bs = $valor_bs; }
		public function getValor_bs(){ return $this->valor_bs; }
		public function setFecha_tasa($fecha_tasa){ $this->fecha_tasa = $fecha_tasa; }
		public function getFecha_tasa(){ return $this->fecha_tasa; }
		



		public function listar(){

			try {

				$sql = ("SELECT * FROM tasa_cambio");

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

				$sql = ("SELECT * FROM tasa_cambio WHERE id = :id");

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

				$sql = ("INSERT INTO tasa_cambio (valor_bs,fecha_tasa ) VALUES (:valor_bs,:fecha_tasa)");

				$stmt = parent::conectar()->prepare($sql);
				
				$stmt->bindparam(":valor_bs", $this->valor_bs, PDO::PARAM_STR);
				$stmt->bindparam(":fecha_tasa", $this->fecha_tasa, PDO::PARAM_STR);
			
				

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

				$sql = ("UPDATE tasa_cambio SET valor_bs =:valor_bs,fecha_tasa=:fecha_tasa WHERE id = :id");

				$stmt = parent::conectar()->prepare($sql);
				$stmt->bindparam(":id", $this->id, PDO::PARAM_STR);
				
                $stmt->bindparam(":valor_bs", $this->valor_bs, PDO::PARAM_STR);
				$stmt->bindparam(":fecha_tasa", $this->fecha_tasa, PDO::PARAM_STR);
				

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

				$sql = ("DELETE FROM tasa_cambio WHERE id = :id");

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