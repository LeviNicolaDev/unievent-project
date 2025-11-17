<?php
// Autoload PSR-4
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

require_once __DIR__ . '/../Config/Connection.php';

use src\Controller\EventoController;
use src\Controller\ResponsavelEventoController;
use src\Controller\SecretariaController;

try {
    $action = $_GET['action'] ?? 'home';
    
    $action = explode('?', $action)[0];
    $action = trim($action);
    $action = strtolower($action);

    switch ($action) {
        case 'loginentrar':
            $controller = new SecretariaController();
            $controller->processarLogin();
            break;
        case 'logincadastrar':
            $controller = new SecretariaController();
            $controller->processarCadastro();
            break;
        case 'processarresponsavel':
            $controller = new ResponsavelEventoController();
            $controller->processarFormulario();
            break;
        case 'updateresponsavel':
            $controller = new ResponsavelEventoController();
            $controller->processarUpdateResponsavel();
            break;
        case 'processarevento':
            $controller = new EventoController();
            $controller->processarFormulario();
            break;
        case 'listareventos':
            $controller = new EventoController();
            $controller->listarEventos();
            break;
        case 'excluirevento':
            $controller = new EventoController();
            $controller->excluirEvento($_GET['id']);
            break;
        case 'visualizaratualizarevento':
            $controller = new EventoController();
            $controller->visualizarAtualizarEvento($_GET['id']);
            break;
        case 'atualizarevento':
            $controller = new EventoController();
            $controller->atualizarEvento($_GET['id']);
            break;
        case 'home':
            header('Location: ../View/home.php');
            exit;
        default:
            http_response_code(404);
            $viewPath = realpath(__DIR__ . '/../src/View/404.php');
            
            if (file_exists($viewPath)) {
                include $viewPath;
            } else {
                // Fallback básico se o arquivo 404.php não existir
                echo "<h1>404 Página Não Encontrada</h1>";
                echo "<p>A página que você está procurando não existe.</p>";
            }
            exit;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo "Erro: " . $e->getMessage();
    error_log($e->getMessage());
    exit;
}