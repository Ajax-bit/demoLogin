<?php

    class db {

        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "Users";
    
        //Conector
        private $conexion;
    
        //Propiedades para controlar errores
        private $error=false;
        private $error_msg="Unable to retreive data at this time";
    
        function __construct() {
            $this->conexion = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conexion->connect_errno) {
                $this->error=true;
                echo $this->error_msg;
            }
        }
    
        // Recibe petición y la consulta con base de datos
        public function consultar($query){
            if($this->error == false){
                $query_result=$this->conexion->query($query);
                return $query_result;
            } else {
                echo $this->error_msg;
                return null;
            }
        }

        
    }

?>