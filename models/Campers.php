<?php
    namespace Models;
    class Campers {

        //definimos las variables 
        protected static $conn;
        protected static $columnsTbl = ['idCamper', 'nombreCamper', 'apellidoCamper', 'fechaNac', 'idReg'];
        private $idCamper;
        private $nombreCamper;
        private $apellidoCamper;
        private $fechaNac;
        private $idReg;

        public function __construct($args = [])
        {
            $this -> idCamper = $args['idCamper'] ?? '';
            $this -> nombreCamper = $args['nombreCamper'] ?? '';
            $this -> apellidoCamper = $args['apellidoCamper'] ?? '';
            $this -> fechaNac = $args['fechaNac'] ?? '';
            $this -> idReg = $args['idReg'] ?? '';
        }

        //definimos la funcion para guardarlos en la base de datos (insertar datos)
        public function saveData($data) {

            $delimiter = ":";
            $dataBd = $this -> sanitizarAttributos();
            $valorCols = $delimiter . join(',:', array_keys($data));
            $cols = join(',', array_keys($data));
            $sql = "INSERT INTO campers ($cols) VALUES ($valorCols)";
            $stmt = self :: $conn -> prepare($sql);
            
            try {
                $stmt -> execute($data);
                $response = [[
                    //'idCamper' => self :: $conn -> lastInsertId(), //permite obtener el ultimo Id que se a insertado (por se auto-incremental)
                    'idCamper' => $data['idCamper'],
                    'nombreCamper' => $data['nombreCamper'],
                    'apellidoCamper' => $data['apellidoCamper'],
                    'fechaNac' => $data['fechaNac'],
                    'idReg' => $data['idReg']
                ]]; 

            } catch (\PDOException $e) {
                return $sql . "<br/>" . $e -> getMessage();
            }
            return $response; 
        }

        //para traer los datos del la base de datos para verla en el HTML
        public function loadAllData() {
            $sql = "SELECT idCamper, nombreCamper, apellidoCamper, fechaNac, idReg FROM campers";
            $stmt = self :: $conn -> prepare($sql);
            $stmt -> execute();
            $miSgav = $stmt -> fetchAll(\PDO :: FETCH_ASSOC);
            return $miSgav;
        }

         //para traer los datos del la base de datos para verla en el HTML
         public function loadAllDataRegion() {
            $sql = "SELECT idReg, nombreReg, idDep FROM region";
            $stmt = self :: $conn -> prepare($sql);
            $stmt -> execute();
            $miSgav = $stmt -> fetchAll(\PDO :: FETCH_ASSOC);
            return $miSgav;
        }

        //funcion para traer datos de la base de datos poa id
        public function loadByIdData($id)
         {
            $sql = "SELECT idCamper, nombreCamper, apellidoCamper, fechaNac, idReg FROM campers WHERE idCamper = $id";
            $stmt = self::$conn->prepare($sql);
            $stmt->execute();
            $miSgav = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $miSgav;
        }

        //funcion para borrar datos de la base de datos
        public function deleteData($id) {
            $sql = "DELETE FROM campers WHERE idCamper = :id";
            $stmt = self :: $conn -> prepare($sql);
            $stmt -> bindParam(':id', $id);
            $stmt -> execute();
        }

        //funcion para editar los datos de la base de datos 
        public function updateData($data) {
            $sql = "UPDATE campers SET nombreCamper = :nombreCamper, apellidoCamper = :apellidoCamper, fechaNac = :fechaNac, idReg = :idReg WHERE idCamper = :idCamper";
            $stmt = self :: $conn -> prepare($sql);
            $stmt -> bindParam(':nombreCamper', $data['nombreCamper']);
            $stmt -> bindParam(':apellidoCamper', $data['apellidoCamper']);
            $stmt -> bindParam(':fechaNac', $data['fechaNac']);
            $stmt -> bindParam(':idReg', $data['idReg']);

            $stmt -> bindParam(':idCamper', $data['idCamper']);
            $stmt -> execute();
        }

        //acontinuacion se escribe la funcion de sanitizacion
        //para prevenir inyesion de cosigo SQL y caracteres especiales 
        public static function setConn($connBd) {
            self :: $conn = $connBd;
        }
        
        public function atributos(){
            $atributos = [];
            foreach (self::$columnsTbl as $columna){
                if($columna === 'idCamper') continue;
                $atributos [$columna]=$this->$columna;
             }
             return $atributos;
        }

        public function sanitizarAttributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$conn->quote($value);
            }
            return $sanitizado;
        }

    }

?>