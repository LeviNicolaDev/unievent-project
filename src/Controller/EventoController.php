<?php

namespace src\Controller;

use PDOException;
use src\Config\Connection;
use src\Model\Evento;
use src\Repository\EventoRepository;
use src\Service\EventoService;

class EventoController
{
    private $repository;
    public function __construct() {
        $this->repository = new EventoRepository();
    }

    public function listarEventos() {
        try {
            $eventos = $this->repository->listarTodos();
            
            $this->carregarView('gerenciarEventos.php', [
                'eventos' => $eventos
            ]);

        } catch (\Exception $e) {
            die("ERRO: " . $e->getMessage() . 
                "<br>Arquivo: " . $e->getFile() . 
                "<br>Linha: " . $e->getLine());
        }
    }
    
    public function excluirEvento($id) {
        try {
            $this->repository->excluir($id);
            header('Location: /UniEvent-Project/public/index.php?action=listarEventos');
            exit;
        } catch (PDOException $e) {    
            error_log("Erro ao excluir evento: " . $e->getMessage());
            echo "Erro ao excluir evento. Por favor, tente novamente.";
        }
    }

    public function visualizarAtualizarEvento($id) {
        try {
            $evento = $this->repository->buscarPorId($id);
            $responsaveis = $this->repository->listarResponsaveis();
            
            if (!$evento) {
                throw new \Exception("Evento não encontrado");
            }
            
            $this->carregarView('atualizarEvento.php', [
                'evento' => $evento,
                'responsaveis' => $responsaveis
            ]);
            
        } catch (\Exception $e) {
            error_log("Erro ao visualizar evento: " . $e->getMessage());
            header('Location: /UniEvent-Project/public/index.php?action=listarEventos');
            exit;
        }
    }

    public function atualizarEvento($id) {
        $repository = new EventoRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['titulo']) &&
                isset($_POST['descricao']) &&
                isset($_POST['capacidade']) &&
                isset($_POST['responsavel']) &&
                isset($_POST['horaEvento']) &&
                isset($_POST['dataEvento']) &&
                isset($_POST['categoriaEvento'])
            ) {
                $thumbnail = null;
                if (!empty($_FILES['thumbnail']['name'])) {
                    $nomeArquivo = $_FILES['thumbnail']['name'];
                    $tipo = $_FILES['thumbnail']['type'];
                    $nomeTemporario = $_FILES['thumbnail']['tmp_name'];
                    $erroTipo = false;
                    $erroMIME = false;

                    // Validação de extensão
                    $arquivosPermitidos = ["png", "jpg", "jpeg"];
                    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                    if (!in_array($extensao, $arquivosPermitidos)) {
                        $erroTipo = true;
                    }

                    // Validação de MIME type
                    $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                    if (!in_array($tipo, $typesPermitidos)) {
                        $erroMIME = true;
                    }

                    if (!$erroTipo && !$erroMIME) {
                        $caminho = __DIR__ . '/../../public/images/uploads/';
                        
                        if (!file_exists($caminho)) {
                            mkdir($caminho, 0777, true);
                        }

                        // Gerar nome único para o arquivo
                        $novoNome = uniqid() . '.' . $extensao;
                        
                        if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
                            $thumbnail = '/images/uploads/' . $novoNome;
                        }
                    }
                }
                
                $titulo = trim($_POST['titulo']);
                $descricao = trim($_POST['descricao']);
                $capacidade = trim($_POST['capacidade']);
                $responsavelId = (int)trim($_POST['responsavel']);
                $horaEvento = trim($_POST['horaEvento']);
                $dataEvento = trim($_POST['dataEvento']);
                $categoriaEvento = trim($_POST['categoriaEvento']);

                if (
                    empty($titulo) || empty($descricao) ||
                    empty($capacidade) || empty($responsavelId) ||
                    empty($horaEvento) || empty($dataEvento) ||
                    empty($categoriaEvento) 
                ) {
                    echo "Preencha todos os campos, incluindo a thumbnail";
                } else {
                    try {
                        $evento = new Evento();
                        $evento->setId($id);
                        $evento->setNome($titulo);
                        $evento->setDescricao($descricao);
                        $evento->setCategoriaEvento($categoriaEvento);
                        $evento->setCapacidade($capacidade);
                        $evento->setThumbnail($thumbnail);
                        $evento->setHoraEvento($horaEvento);
                        $evento->setDataEvento($dataEvento);
                        $evento->setIdResponsavelEventoFk($responsavelId);
                      
                        if ($repository->atualizar($evento)) {
                            header('Location: /UniEvent-Project/public/index.php?action=listarEventos');
                            exit;
                        }   
                     
                    } catch (PDOException $e) {
                    
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }
    }

    private function carregarView($view, $data = []) {
        extract($data);
        
        $viewDir = realpath(__DIR__ . '/../View/');
        
        if (!$viewDir) {
            throw new \Exception("Diretório View não encontrado. Verifique a estrutura de pastas.");
        }
        
        $viewPath = $viewDir . '/' . $view;
        
        if (!file_exists($viewPath)) {
            throw new \Exception("Arquivo de view não encontrado: " . $viewPath . 
                            "\nViews disponíveis: " . implode(', ', scandir($viewDir)));
        }
        
        require $viewPath;
    }


    public function processarFormulario() {

        $repository = new EventoRepository();

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Carregar a view de criação com lista de responsáveis
            try {
                $responsaveis = $repository->listarResponsaveis();
                
                $this->carregarView('criarEvento.php', [
                    'responsaveis' => $responsaveis
                ]);
                
            } catch (\Exception $e) {
                die("ERRO: " . $e->getMessage() . 
                    "<br>Arquivo: " . $e->getFile() . 
                    "<br>Linha: " . $e->getLine());
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (
                isset($_POST['titulo']) &&
                isset($_POST['descricao']) &&
                isset($_POST['capacidade']) &&
                isset($_POST['responsavel']) &&
                isset($_POST['horaEvento']) &&
                isset($_POST['dataEvento']) &&
                isset($_POST['categoriaEvento'])
            ) {
                $thumbnail = null;
                if (!empty($_FILES['thumbnail']['name'])) {
                    $nomeArquivo = $_FILES['thumbnail']['name'];
                    $tipo = $_FILES['thumbnail']['type'];
                    $nomeTemporario = $_FILES['thumbnail']['tmp_name'];
                    $erroTipo = false;
                    $erroMIME = false;

                    // Validação de extensão
                    $arquivosPermitidos = ["png", "jpg", "jpeg"];
                    $extensao = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));
                    if (!in_array($extensao, $arquivosPermitidos)) {
                        $erroTipo = true;
                    }

                    // Validação de MIME type
                    $typesPermitidos = ["image/png", "image/jpg", "image/jpeg"];
                    if (!in_array($tipo, $typesPermitidos)) {
                        $erroMIME = true;
                    }

                    if (!$erroTipo && !$erroMIME) {
                        $caminho = __DIR__ . '/../../public/images/uploads/';
                        
                        if (!file_exists($caminho)) {
                            mkdir($caminho, 0777, true);
                        }

                        // Gerar nome único para o arquivo
                        $novoNome = uniqid() . '.' . $extensao;
                        
                        if (move_uploaded_file($nomeTemporario, $caminho . $novoNome)) {
                            $thumbnail = '/images/uploads/' . $novoNome;
                        }
                    }
                }
                
                $titulo = trim($_POST['titulo']);
                $descricao = trim($_POST['descricao']);
                $capacidade = trim($_POST['capacidade']);
                $responsavelId = (int)trim($_POST['responsavel']);
                $horaEvento = trim($_POST['horaEvento']);
                $dataEvento = trim($_POST['dataEvento']);
                $categoriaEvento = trim($_POST['categoriaEvento']);

                if (
                    empty($titulo) || empty($descricao) ||
                    empty($capacidade) || empty($responsavelId) ||
                    empty($horaEvento) || empty($dataEvento) ||
                    empty($categoriaEvento) || $thumbnail === null
                ) {
                    if (empty($thumbnail)) {
                        echo "<script>alert('Preencha a thumbnail');</script>";
                        echo '<br>' . $thumbnail;
                    } else {
                        echo "<script>alert('Preencha todos os campos');</script>";
                        echo '<br>' . $thumbnail;
                    }
                } else {
                    try {
                        $evento = new Evento();
                        $evento->setNome($titulo);
                        $evento->setDescricao($descricao);
                        $evento->setCategoriaEvento($categoriaEvento);
                        $evento->setCapacidade($capacidade);
                        $evento->setThumbnail($thumbnail);
                        $evento->setHoraEvento($horaEvento);
                        $evento->setDataEvento($dataEvento);
                        $evento->setIdResponsavelEventoFk($responsavelId);
                      
                        echo 'Dados enviados';
                        
                       return $repository->save($evento) && header('Location: ../public/index.php?action=listarEventos');
                     
                    } catch (PDOException $e) {
                    
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }
    }
}