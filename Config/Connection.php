<?php
namespace src\Config;
    use PDO;
    use PDOException;

    class Connection{
        private $server = $_ENV['DB_HOST'];
        private $username= $_ENV['DB_USER'];
        private $db_name= $_ENV['DB_NAME'];
        private $password= $_ENV['DB_PASSWORD'];
        private $port= $_ENV['DB_PORT'];

        public $conn;

        function __construct(){
            $this->getConnection();
        }

        public function getConnection(){
            try{
                $dsn = "mysql:host=$this->server;port=$this->port;dbname=$this->db_name";
                $this->conn=new PDO($dsn, $this->username, $this->password);
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