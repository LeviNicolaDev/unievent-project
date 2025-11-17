<?php

namespace src\Controller;

use PDOException;
use src\Model\ResponsavelEvento;
use src\Repository\ResponsavelEventoRepository;

class ResponsavelEventoController{

    public function processarFormulario(){
        $repository = new ResponsavelEventoRepository();

        if($_SERVER['REQUEST_METHOD']== 'POST'){
            if(isset($_POST['nome'])){
                
                $nome=trim($_POST['nome']);
                $fotoPerfil = '';
                
                // Processar upload da foto
                if(isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0){
                    $uploadDir = __DIR__ . '/../View/assets/images/uploads/';
                    if(!is_dir($uploadDir)){
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    $fileName = uniqid() . '_' . $_FILES['fotoPerfil']['name'];
                    $uploadPath = $uploadDir . $fileName;
                    
                    if(move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadPath)){
                        $fotoPerfil = 'assets/images/uploads/' . $fileName;
                    }
                }
                
                if(empty($nome)){
                    echo "preencha todos os campos";
                }
                else{  
                        try{
                            $responsavel = new ResponsavelEvento();
                            $responsavel->setNome($nome);
                            $responsavel->setFotoPerfil($fotoPerfil);
                            
                            $repository->save($responsavel);
                            return header('Location: ../src/View/home.php');
                        }catch(PDOException $e){
                            echo "Error".$e;
                        }
                    
                    }
            }
        }
    }
    
    public function processarUpdateResponsavel() {
        $repository = new ResponsavelEventoRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (isset($_POST['nome']) && isset($_POST['id'])) {
                $id = (int)$_POST['id'];
                $nome=trim($_POST['nome']);
                $fotoPerfil = '';

                // Processar upload da foto
                if(isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] == 0){
                    $uploadDir = __DIR__ . '/../View/assets/images/uploads/';
                    if(!is_dir($uploadDir)){
                        mkdir($uploadDir, 0777, true);
                    }
                    
                    $fileName = uniqid() . '_' . $_FILES['fotoPerfil']['name'];
                    $uploadPath = $uploadDir . $fileName;
                    
                    if(move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $uploadPath)){
                        $fotoPerfil = 'assets/images/uploads/' . $fileName;
                    }
                }

                if (empty($nome)) {
                    echo 'Preencha todos os campos.';
                } else {
                    try {
                        $responsavel = new ResponsavelEvento();
                        $responsavel->setId($id);
                        $responsavel->setNome($nome);
                        $responsavel->setFotoPerfil($fotoPerfil);
                        
                        $repository->update($responsavel);
                        return true;
                    } catch(PDOException $e){
                        echo "Error".$e;
                    }
                }
            }
        }
    } 
}

?>