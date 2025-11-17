<?php
namespace src\Controller;

use PDO;
use PDOException;
use src\Config\Connection;
use src\Model\Secretaria;
use src\Repository\SecretariaRepository;
use src\Service\SecretariaService;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class SecretariaController {
    private $repository;
    
    public function __construct() {
        $this->repository = new SecretariaRepository();
    }

    public function processarLogin() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['email'], $_POST['senha'])) {
            $this->redirecionarComMensagem('Dados incompletos!', '/unievent-project/src/View/login.php', 'error');
            return;
        }

        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        try {
            $resultado = $this->repository->checarLogin($email, $senha);
            
            switch ($resultado['status']) {
                case 'sucesso':
                    $_SESSION['usuario_id'] = $resultado['usuario']->id;
                    $_SESSION['usuario_email'] = $resultado['usuario']->email;
                    $_SESSION['usuario_nome'] = $resultado['usuario']->nome ?? '';
                    header('Location: /unievent-project/src/View/home.php');
                    exit();
                    
                case 'credenciais_invalidas':
                    $msg = 'Credenciais inválidas!';
                    if (isset($resultado['tentativas_restantes'])) {
                        $msg .= " Tentativas restantes: " . $resultado['tentativas_restantes'];
                    }
                    $this->redirecionarComMensagem($msg, '/unievent-project/src/View/login.php', 'error');
                    break;
                    
                case 'conta_bloqueada':
                    $this->enviarEmailAlerta($resultado['usuario']->email, $resultado['usuario']->nome);
                    $this->redirecionarComMensagem('Limite de tentativas excedido.', '/unievent-project/src/View/login.php', 'error');
                    break;
                    
                case 'email_nao_confirmado':
                    $this->redirecionarComMensagem('Necessário confirmar o e-mail!', '/unievent-project/src/View/login.php', 'error');
                    break;
                    
                case 'conta_inativa':
                    $this->redirecionarComMensagem('Perfil não encontrado!', '/unievent-project/src/View/login.php', 'error');
                    break;
                    
                default:
                    $this->redirecionarComMensagem('Erro no login. Tente novamente.', '/unievent-project/src/View/login.php', 'error');
                    break;
            }
            
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Erro no sistema. Tente novamente.', '/unievent-project/src/View/login.php', 'error'
            );
        }
    }

    public function processarCadastro() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['nome'], $_POST['email'], $_POST['senha'])) {
            $this->redirecionarComMensagem('Dados incompletos!', '/unievent-project/src/View/login.php', 'error');
            return;
        }

        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        $connection = new Connection();
        $pdo = $connection->getConnection();

        if (!SecretariaService::validarEmail($email, $pdo)) {
            $this->redirecionarComMensagem('Email inválido ou já cadastrado!', '/unievent-project/src/View/login.php', 'error');
            return;
        }

        try {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $secretaria = new Secretaria();
            $secretaria->setNome($nome);
            $secretaria->setEmail($email);
            $secretaria->setSenha($senhaHash);
            
            $resultado = $this->repository->criarLoginSecretaria($secretaria);
            
            if (!$resultado || !isset($resultado['chave'])) {
                throw new \Exception('Falha ao criar usuário');
            }

            $this->enviarEmailConfirmacao($email, $nome, $resultado['chave']);

            $this->redirecionarComMensagem('Usuário cadastrado com sucesso. Necessário ativar a conta pelo email de confirmação.', '/unievent-project/src/View/login.php', 'success');
            
        } catch (PDOException $e) {
            $this->redirecionarComMensagem('Erro no banco de dados: ' . $e->getMessage(), '/unievent-project/src/View/login.php', 'error');
        } catch (\Exception $e) {
            $this->redirecionarComMensagem($e->getMessage(), '/unievent-project/src/View/login.php', 'error');
        }
    }

    private function enviarEmailConfirmacao($email, $nome, $chave) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'adm.unievent@gmail.com';
            $mail->Password   = 'jnmmzgexlpvbpwos';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->SMTPKeepAlive = true;
            $mail->Timeout = 20;
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            
            $mail->setFrom('adm.unievent@gmail.com', 'Administração');
            $mail->addAddress($email, $nome);
            
            $mail->isHTML(true);
            $mail->Subject = 'Confirme o e-mail';
            $mail->Body    = $this->getEmailConfirmacaoBody($nome, $chave);
            $mail->AltBody = $this->getEmailConfirmacaoTextBody($nome, $chave);
            
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Erro ao enviar email: {$mail->ErrorInfo}");
        } finally {
            $mail->smtpClose();
        }
    }

        private function enviarEmailAlerta($email, $nome) {
        $mail = new PHPMailer(true);
        
        try {
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'adm.unievent@gmail.com';
            $mail->Password   = 'jnmmzgexlpvbpwos';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->SMTPKeepAlive = true;
            $mail->Timeout = 20;
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            
            $mail->setFrom('adm.unievent@gmail.com', 'Administração');
            $mail->addAddress($email, $nome);
            
            $mail->isHTML(true);
            $mail->Subject = 'Alerta de segurança - UniEvent';
            $mail->Body    = $this->getEmailAlertaBody($nome);
            $mail->AltBody = $this->getEmailAlertaTextBody($nome);
            
            $mail->send();
        } catch (Exception $e) {
            throw new \Exception("Erro ao enviar email: {$mail->ErrorInfo}");
        } finally {
            $mail->smtpClose();
        }
    }

    // Email de confirmação simples
    private function getEmailConfirmacaoBody($nome, $chave) {
        return "Prezado(a) " . $nome . ".<br><br>Agradecemos a sua solicitação de cadastro em nosso sistema!<br><br>Para que possamos liberar o seu cadastro
        em nosso sistema, solicitamos a confirmação do e-mail por meio deste link abaixo: <br><br><a href='http://localhost/unievent-project/src/Service/ConfirmarEmail.php?chave=$chave'>Clique aqui</a><br><br>
        Esta mensagem foi enviada automaticamente pela UniEvent.<br>Você está recebendo este e-mail porque seu endereço está cadastrado em nosso sistema.<br>
        Atenção: nunca solicitamos o envio de senhas, dados pessoais ou arquivos anexados por e-mail.<br><br>Em caso de dúvidas, entre em contato com nosso suporte.<br><br>
        Atenciosamente,<br>Equipe UniEvent.";
    }

    private function getEmailConfirmacaoTextBody($nome, $chave) {
        return "Prezado(a) " . $nome . ".\n\nAgradecemos a sua solicitação de cadastro em nosso sistema!\n\nPara que possamos liberar o seu cadastro
        em nosso sistema, solicitamos a confirmação do e-mail por meio deste link abaixo: \n\nhttp://localhost/unievent-project/src/Service/ConfirmarEmail.php?chave=$chave\n\n
        Esta mensagem foi enviada automaticamente pela UniEvent.\nVocê está recebendo este e-mail porque seu endereço está cadastrado em nosso sistema.\n
        Atenção: nunca solicitamos o envio de senhas, dados pessoais ou arquivos anexados por e-mail.<br><br>Em caso de dúvidas, entre em contato com nosso suporte.\n\n
        Atenciosamente,\nEquipe UniEvent.";
    }

    // Email de alerta com link de mudança de senha que podemos implementar mais tarde
    private function getEmailAlertaBody($nome) {
        return "Prezado(a) {$nome},<br><br>
        Identificamos tentativas de acesso não autorizadas à sua conta no sistema UniEvent.<br><br>
        Por segurança, recomendamos que você altere sua senha o quanto antes. Para isso, acesse o link abaixo:<br><br>
        <a href='http://localhost/unievent-project/src/Service/MudarSenha.php?'>Clique aqui para alterar sua senha</a><br><br>
        Esta mensagem foi enviada automaticamente pela UniEvent.<br>
        Você está recebendo este e-mail porque seu endereço está cadastrado em nosso sistema.<br>
        Atenção: nunca solicitamos o envio de senhas, dados pessoais ou arquivos anexados por e-mail.<br><br>
        Em caso de dúvidas, entre em contato com nosso suporte.<br><br>
        Atenciosamente,<br>
        Equipe UniEvent.";
    }


    private function getEmailAlertaTextBody($nome) {
        return "Prezado(a) {$nome},\n
        Identificamos tentativas de acesso não autorizadas à sua conta no sistema UniEvent.\n
        Por segurança, recomendamos que você altere sua senha o quanto antes. Para isso, acesse o link abaixo:\n\n
        http://localhost/unievent-project/src/Service/MudarSenha.php\n\n
        Esta mensagem foi enviada automaticamente pela UniEvent.\n
        Você está recebendo este e-mail porque seu endereço está cadastrado em nosso sistema.\n
        Atenção: nunca solicitamos o envio de senhas, dados pessoais ou arquivos anexados por e-mail.\n
        Em caso de dúvidas, entre em contato com nosso suporte.
        Atenciosamente,\nEquipe UniEvent.";
    }

    private function redirecionarComMensagem($mensagem, $url, $tipoMensagem) {
        if ($tipoMensagem == "error") {
            $_SESSION['msg'] = "<div class='alert-message alert-error'>$mensagem</div>";
        } else if ($tipoMensagem == "success"){
            $_SESSION['msg'] = "<div class='alert-message alert-success'>$mensagem</div>";
        }
        header("Location: $url");
        exit();
    }
}
?>