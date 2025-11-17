<?php

namespace src\Model;

class ResponsavelEvento{

   private $id;
   private $nome;
   private $fotoPerfil;

   public function __construct()
   {
   }

   public function setId($id){
      return $this->id=$id;
   }

   public function getId(){
      return $this->id;
   }

   public function setNome($nome){
      return $this->nome=$nome;
   }

   public function getNome(){
      return $this->nome;
   }

   public function setFotoPerfil($fotoPerfil){
      return $this->fotoPerfil=$fotoPerfil;
   }

   public function getFotoPerfil(){
      return $this->fotoPerfil;
   }
   
}
?>