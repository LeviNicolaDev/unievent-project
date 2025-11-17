<?php 
    session_start();
    ob_start();

    require_once(__DIR__ . '/../../Config/Connection.php');

    use src\Config\Connection;

    $connection = new Connection();
    $conn = $connection->getConnection();

    $chave = filter_input(INPUT_GET, "chave", FILTER_SANITIZE_STRING);

    if (!empty($chave)) {
        $query_usuario_pes = "SELECT id FROM secretaria WHERE chave=:chave LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario_pes);
        $result_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
        $result_usuario->execute();
        
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) { // Encontrou a chave no banco de dados
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            extract($row_usuario);
            $query_update_usuario = "UPDATE secretaria SET situacao = 'ativo', chave = :chave WHERE id=$id";
            $update_usuario = $conn->prepare($query_update_usuario);
            $chave = NULL;
            $update_usuario->bindParam(':chave', $chave, PDO::PARAM_STR);
            if ($update_usuario->execute()) {
                $_SESSION['msg'] = "<div class='alert-message alert-success'>E-mail confirmado.</div>";
                header("Location: /../unievent-project/src/View/login.php");
            } else {
                $_SESSION['msg'] = "<div class='alert-message alert-error'>E-mail não confirmado.</div>";
                header("Location: /../unievent-project/src/View/login.php");   
            }
        } else { // Não encontrou a chave no banco de dados
            $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: endereço inválido.</div>";
            header("Location: /../unievent-project/src/View/login.php");  
        }
    } else {
        $_SESSION['msg'] = "<div class='alert-message alert-error'>Erro: endereço inválido.</div>";
        header("Location: /../unievent-project/src/View/login.php");
    }
?>