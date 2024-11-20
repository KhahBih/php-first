<?php 
    class Database{
        private $host = 'localhost';
        private $db_user = 'root';
        private $db_password = '';
        private $db_name = 'todo_app_mysqli_oop';
        public $conn;

        public function connect(){
            $this->conn = null;
            try{
                $this->conn = new mysqli($this->host, $this->db_user, $this->db_password, $this->db_name);
                if($this->conn->connect_error){
                    die('Connection failed'.$this->conn->connect_error);
                }
            }catch(Exception $error){
                echo 'Connection error'.$error->getMessage();
            }

            return $this->conn;
        }
    }
?>