<?php

namespace src\Repository;

use src\Config\Connection;
use PDOException;
use PDO;
use src\Model\ResponsavelEvento;

class ResponsavelEventoRepository {
   
    private $pdo;
    
    public function __construct() {
        require_once(__DIR__ . '/../../Config/Connection.php');
        $conexao = new Connection();
        $this->pdo = $conexao->getConnection();
    }

    public function save(ResponsavelEvento $responsavelEvento): ResponsavelEvento {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO responsavelevento (nome, fotoPerfil) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                $responsavelEvento->getNome(),
                $responsavelEvento->getFotoPerfil()
            ]);

            $id = $this->pdo->lastInsertId();
            $responsavelEvento->setId($id);

            $this->pdo->commit(); 

            return $responsavelEvento; 

        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function update(ResponsavelEvento $responsavelEvento): bool {
        try {
            $this->pdo->beginTransaction();

            $sql = "UPDATE responsavelevento SET nome = ?, fotoPerfil = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([
                $responsavelEvento->getNome(),
                $responsavelEvento->getFotoPerfil(),
                $responsavelEvento->getId()
            ]);

            $this->pdo->commit();
            return $result;

        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }

    public function findById(int $id): ?ResponsavelEvento {
        try {
            $sql = "SELECT * FROM responsavelevento WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$data) {
                return null;
            }

            $responsavel = new ResponsavelEvento();
            $responsavel->setId($data['id']);
            $responsavel->setNome($data['nome']);
            $responsavel->setFotoPerfil($data['fotoPerfil']);

            return $responsavel;

        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function listarResponsaveis(): array {
        try {
            $sql = "SELECT * FROM responsavelevento ORDER BY nome";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $responsaveis = [];
            foreach ($data as $row) {
                $responsavel = new ResponsavelEvento();
                $responsavel->setId($row['id']);
                $responsavel->setNome($row['nome']);
                $responsavel->setFotoPerfil($row['fotoPerfil']);
                $responsaveis[] = $responsavel;
            }

            return $responsaveis;

        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete(int $id): bool {
        try {
            $this->pdo->beginTransaction();

            $sql = "DELETE FROM responsavelevento WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute([$id]);

            $this->pdo->commit();
            return $result;

        } catch (PDOException $e) {
            if ($this->pdo && $this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            throw $e;
        }
    }
}
?>
