<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="assets/css/styleHome.css" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet" />
<title>UniEvent</title>
</head>

<body>
    <header class="container-sup">
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="greeting">Olá, <?php echo $_SESSION['usuario_nome']; ?></p>
        </div>
        <div class="seleção">
            <div class="unidade">
                <img src="assets/images/logo-fatec.png" alt="" class="logo-unidade" />
                <p class="txt-unidade" data-i18n="manage_units">Gerenciar Unidades</p>
            </div>
            <a href="suporte.php" class="suporte">
                <img src="assets/images/suport.png" alt="" class="logo-suporte" />
                <p class="txt-suporte" data-i18n="support">Suporte</p>
            </a>
        </div>
        <a href="login.php" class="btn-sair"><i class="fa-solid fa-person-running"></i>
            <span data-i18n="logout">Sair</span></a>
    </header>

    <div class="funcionalidades">
        <a href="/UniEvent-Project/public/index.php?action=processarEvento" class="criar-evento">
            <div class="criar-evento">
                <img src="assets/images/img-criar-evento.png" alt="" class="img-criar-evento" />
                <p class="txt-funcionalidade-evento" data-i18n="create_event">
                    Criar Evento
                </p>
            </div>
        </a>
        <a href="/UniEvent-Project/public/index.php?action=listarEventos" class="gerenciar-evento">
            <div class="gerenciar-evento">
                <img src="assets/images/img-gerenciar-evento.png" alt="" class="img-geren-evento" />
                <p class="txt-funcionalidade-geren" data-i18n="manage_events">
                    Gerenciar Eventos
                </p>
            </div>
        </a>
        <a href="#" class="gerenciar-pessoas">
            <div class="gerenciar-pessoas">
                <img src="assets/images/userIconManagement.svg" alt="" class="img-pessoas" />
                <p class="txt-funcionalidade-pessoas" data-i18n="manage_people">
                    Gerenciar Pessoas
                </p>
            </div>
        </a>
        <a href="criarResponsavel.php" class="gerenciar-pessoas">
            <div class="gerenciar-pessoas">
                <img src="assets/images/userIconAdd.svg" alt="" class="img-pessoas" />
                <p class="txt-funcionalidade-pessoas" data-i18n="create_responsible">
                    Criar Responsável
                </p>
            </div>
        </a>
        <a href="#" class="gerenciar-certificados">
            <div class="gerenciar-certificados">
                <img src="assets/images/img-certificado.png" alt="" class="img-certificados" />
                <p class="txt-funcionalidade-cert" data-i18n="manage_certificates">
                    Gerenciar Certificados
                </p>
            </div>
        </a>
    </div>

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
        const nomeUsuario = "<?php echo addslashes($_SESSION['usuario_nome']); ?>";
    </script>

    <script src="assets/js/traducaoHome.js"></script>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
        }
    });
    </script>
    
</body>
</html>