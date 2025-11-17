<?php

namespace src\Model;

use src\Config\Connection;

class Evento  {
    private $id;
    private $nome;
    private $descricao;
    private $categoria_evento;
    private $hora_evento;
    private $data_evento;
    private $capacidade;
    private $thumbnail;
    private $thumbnail2;
    private $thumbnail3;
    private $id_responsavel_evento_fk;
    private $id_endereco_fk;

    private $table;

    public function setId($id) {
        return $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        return $this->nome = $nome;
    }
    public function getNome() {
        return $this->nome;
    }

    public function setDescricao($descricao) {
        return $this->descricao = $descricao;
    }
    public function getDescricao() {
        return $this->descricao;
    }

    public function setHoraEvento($hora_evento) {
        return $this->hora_evento = $hora_evento;
    }
    public function getHoraEvento() {
        return $this->hora_evento;
    }

    public function setDataEvento($data_evento) {
        return $this->data_evento = $data_evento;
    }
    public function getDataEvento() {
        return $this->data_evento;
    }

    public function setCapacidade($capacidade) {
        return $this->capacidade = $capacidade;
    }
    public function getCapacidade() {
        return $this->capacidade;
    }

    public function setThumbnail($thumbnail) {
        return $this->thumbnail = $thumbnail;
    }
    public function getThumbnail() {
        return $this->thumbnail;
    }

    public function setThumbnail2($thumbnail2) {
        return $this->thumbnail2 = $thumbnail2;
    }
    public function getThumbnail2() {
        return $this->thumbnail2;
    }


    public function setThumbnail3($thumbnail3) {
        return $this->thumbnail3 = $thumbnail3;
    }
    public function getThumbnail3() {
        return $this->thumbnail3;
    }

    public function setCategoriaEvento($categoria_evento) {
        return $this->categoria_evento = $categoria_evento;
    }
    public function getCategoriaEvento() {
        return $this->categoria_evento;
    }

    public function getIdResponsavelEventoFk() {
        return $this->id_responsavel_evento_fk;
    }
    public function setIdResponsavelEventoFk($id_responsavel_evento_fk) {
        $this->id_responsavel_evento_fk = $id_responsavel_evento_fk;
    }

    public function getIdEnderecoFk() {
        return $this->id_endereco_fk;
    }
    public function setIdEnderecoFk($id_endereco_fk) {
        $this->id_endereco_fk = $id_endereco_fk;
    }
}
?>