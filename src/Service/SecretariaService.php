<?php
namespace src\Service;
use src\Config\Connection;
use PDO;

session_start();
ob_start();
require_once(__DIR__ . '/../../Config/Connection.php');

class SecretariaService {
    private $pdo;

    public function __construct() {
        $connection = new Connection();
        $this->pdo = $connection->getConnection();
    }

    public static function validarEmail($email, PDO $pdo): bool {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) as total FROM secretaria WHERE email = :email");
        $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $checkStmt->execute();
        $countResult = $checkStmt->fetch(PDO::FETCH_OBJ);
        
        if ($countResult->total > 0) {
            $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: Já existe conta com este e-mail.</div>";
            return false;
        } 

        return (bool) preg_match('/^[a-zA-Z0-9._%+-]+@fatec\.sp\.gov\.br$/i', $email);
    }
}
?>