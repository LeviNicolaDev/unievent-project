<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Animado</title>
    <link rel="stylesheet" href="assets/css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3ba46d9076.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="div-unievent-logo">
        <img src="assets/images/unieventAdminLogo.svg" alt="" class="unievent-logo">
        <p>ADMIN</p>
    </div>

    <div class="login-container">
        <div class="content first-content">
            <div class="first-column">
                <a href="index.php" class='arrow-button'>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <h2 class='titulo titulo-primary' data-i18n="welcome">Bem-Vindo!</h2>
                <p class="descricao descricao-primary" data-i18n="login_prompt_line1">Entre com seus dados de login</p>
                <p class="descricao descricao-primary" data-i18n="login_prompt_line2">para começar a experiência</p>
                <button id='signin' class='btn btn-primary' data-i18n="login_button">Entrar</button>
            </div>
            <div class="second-column">
                <div class="message-container">
                    <?php 
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                    ?>
                </div>

                <h2 class="titulo titulo-second" data-i18n="create_account">Criar conta</h2>
                <p class="descricao descricao-second" data-i18n="use_institutional_email">Utilize seu email
                    institucional</p>
                <form action="/unievent-project/public/index.php?action=loginCadastrar" class="formulario"
                    method='post'>
                    <label class='label-input'>
                        <i class="fa-solid fa-user icon-modify"></i>
                        <input type="text" name="nome" data-i18n="name_placeholder" placeholder='Nome' value='teste'>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-envelope icon-modify"></i>
                        <input type="email" name="email" data-i18n="email_label" placeholder='Email Institucional'
                            value='teste@fatec.sp.gov.br'>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-lock icon-modify"></i>
                        <input type="password" name="senha" data-i18n="password_placeholder" placeholder='Senha'
                            value=1234>
                    </label>
                    <button class="btn btn-second" data-i18n="register_button">Cadastrar</button>
                </form>
            </div>
        </div>

        <div class="content second-content">
            <div class="first-column">
                <a href="index.php" class='arrow-button'>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class='titulo titulo-primary' data-i18n="hello">Olá!</h2>
                <p class="descricao descricao-primary" data-i18n="connect_prompt_line1">Para se conectar a nós</p>
                <p class="descricao descricao-primary" data-i18n="connect_prompt_line2">por favor, faça o cadastro</p>
                <button id='signup' class='btn btn-primary' data-i18n="register_button">Cadastrar</button>
            </div>
            <div class="second-column">
                <h2 class="titulo titulo-second" data-i18n="login_to_start">Entre para iniciar</h2>
                <p class="descricao descricao-second" data-i18n="use_institutional_email">Utilize seu email
                    institucional</p>
                <form action="/unievent-project/public/index.php?action=loginEntrar" class="formulario" method='post'>
                    <label class='label-input'>
                        <i class="fa-solid fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder='Email Institucional' value='teste@fatec.sp.gov.br'
                            required>
                    </label>
                    <label class='label-input'>
                        <i class="fa-solid fa-lock icon-modify"></i>
                        <input type="password" name="senha" placeholder='Senha' value='1234' required>
                    </label>
                    <a class='password' href='#' data-i18n="forgot_password">Esqueci minha senha</a>
                    <button class="btn btn-second" type='submit' data-i18n="enter">Entrar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- VLibras Plugin -->
    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>

    <script>
    new window.VLibras.Widget("https://vlibras.gov.br/app");
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
        }
    });
    </script>

    <script src="assets/js/traducaoLogin.js"></script>
    <script src="assets/js/Login.js"></script>
    
</body>
</html>