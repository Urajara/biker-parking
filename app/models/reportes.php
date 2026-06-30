<?php

    require_once '../../config/conex.php';

    class reportesModel extends Conexion {

        private $fecha;

        public function setFecha($fecha){ $this->fecha = $fecha; }
        public function getFecha(){ return $this->fecha; }

        // 1. OBTENER TOTALES GENERALES DEL DÍA (Motos, Ganancias y Tasa Dinámica Real)
        // 1. OBTENER TOTALES GENERALES DEL DÍA (Motos, Ganancias y Tasa Dinámica Real)
        public function obtenerTotalesDiarios(){
            try {
                // Tasa base de respaldo por seguridad
                $tasaActual = 40.50; 

                try {
                    // CORREGIDO: Ordenamos por 'fecha_tasa DESC' para asegurar la última actualización cronológica
                    $sqlTasa = "SELECT valor_bs FROM tasa_cambio ORDER BY fecha_tasa DESC LIMIT 1";
                    $stmtTasa = parent::conectar()->prepare($sqlTasa);
                    $stmtTasa->execute();
                    $regTasa = $stmtTasa->fetch(PDO::FETCH_ASSOC);
                    
                    if ($regTasa && isset($regTasa['valor_bs'])) {
                        $tasaActual = floatval($regTasa['valor_bs']);
                    }
                } catch (Exception $eTasa) {
                    // Si algo falla, mantiene el base
                }

                // Conteo de tickets y sumatoria de pagos en dólares del día actual
                $sqlMotos = "SELECT 
                                IFNULL(COUNT(t.id), 0) AS total_motos,
                                IFNULL(SUM(p.monto_dolares), 0.00) AS ganancia_total
                            FROM ticket t
                            LEFT JOIN pago p ON t.id = p.id_ticket
                            WHERE t.fecha_entrada = CURDATE()";

                $stmtMotos = parent::conectar()->prepare($sqlMotos);
                $stmtMotos->execute();
                $data = $stmtMotos->fetch(PDO::FETCH_ASSOC);

                $dataFinal = [
                    'total_motos'    => ($data) ? intval($data['total_motos']) : 0,
                    'ganancia_total' => ($data) ? floatval($data['ganancia_total']) : 0.00,
                    'tasa_dia'       => $tasaActual
                ];

                $result = array('success' => true, 'datos' => $dataFinal);

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
        } #Fin Funcion
        // 2. OBTENER EL DESGLOSE DE MOTOS POR ZONA (Trae todas desde la tabla maestro)
        public function obtenerMotosPorZona(){
            try {
                // CORREGIDO SEGÚN TU MER: La tabla maestra se llama 'zonas' (en plural)
                $sql = "SELECT 
                            z.nombre_zona, 
                            COUNT(t.id) AS total_motos
                        FROM zonas z
                        LEFT JOIN ticket t ON z.id_zona = t.id_zona AND t.fecha_entrada = CURDATE()
                        GROUP BY z.id_zona, z.nombre_zona
                        ORDER BY z.nombre_zona ASC";

                $stmt = parent::conectar()->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!$data) {
                    $data = [];
                }

                $result = array('success' => true, 'datos' => $data);

            } catch ( Exception $e ) {
                $result = array('success' => false, 'error' => 1, 'msj' => $e->getMessage() );
            }

            return $result;
        } #Fin Funcion

    } #Fin clase
?>