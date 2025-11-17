<?php
  namespace src\Config;
    use PDO;
    use PDOException;

    class Connection{
        private $server = "localhost";
        private $username= "root";
        private $db_name= "bdunievent";
        private $password="";
        private $port='3307';
        public $conn;

        function __construct(){
            $this->getConnection();
        }

        public function getConnection(){
            try{
                $this->conn=new PDO("mysql:host=$this->server:$this->port;dbname=$this->db_name",$this->username,$this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
                $this->conn->exec('set names utf8');
                 return $this->conn;
            }
            catch(PDOException $e){
               die( "ERROR: ".$e->getMessage());
            }
           
        }
        
    }
?>