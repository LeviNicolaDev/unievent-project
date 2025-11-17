<?php 
namespace src\Model;

class Secretaria {
    private $nome;
    private $email;
    private $senha;

    public function setNome($nome) {
        return $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setEmail($email) {
        return $this->email = $email;
    }
    public function getEmail() {
        return $this->email;
    }

    public function setSenha($senha) {
        return $this->senha = $senha;
    }
    public function getSenha() {
        return $this->senha;
    }
}
?>