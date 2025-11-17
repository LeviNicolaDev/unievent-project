<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title>UniEvent</title>
</head>

<body>
    <header>
        <div class="fundo-laranja">
            <div class="container-inicio">
                <nav>
                    <div class="container-imagem">
                        <img src="assets/images/logo.svg" alt="Logo" />
                    </div>
                    <div class="navegacao">
                        <a href="#header-sobre" data-i18n="nav.about">Sobre</a>
                        <a href="#aplicativo" data-i18n="nav.app">Aplicativo</a>
                        <a href="#integrantes" data-i18n="nav.members">Integrantes</a>
                    </div>
                    <div class="login">
                        <button type="button" onclick="window.location.href = 'login.php';" class="button-login"
                            data-i18n="nav.login">
                            Login
                        </button>
                    </div>
                    <div class="github">
                        <a href="https://github.com/0RyanSouza0/landing-page-unievent" target="_blank">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </nav>
            </div>

            <section class="header-sobre" id="header-sobre">
                <div class="container-texto">
                    <p data-i18n="header.slogan">DESCUBRA, CONECTE E PARTICIPE!</p>
                    <p class="sobre-app" data-i18n="header.description">
                        O UniEvent é um aplicativo desenvolvido com o objetivo de ser um
                        gerenciador de eventos institucionais, voltado principalmente para
                        universidades, faculdades e outras instituições de ensino...
                    </p>
                    <button type="button" data-i18n="header.button">Ver Mais</button>
                </div>

                <div class="container-image-sobre">
                    <img src="assets/images/letrabranca.svg" alt="Logo Sobre" />
                </div>
            </section>
        </div>
    </header>

    <section class="app" id="aplicativo">
        <img class="img-letra" src="assets/images/letrabranca.svg" alt="" />
        <p data-i18n="app.title">TELAS</p>

        <div class="container-image-app">
            <div class="card">
                <img src="assets/images/Intro.svg" alt="foto 1" />
            </div>
            <div class="card">
                <img src="assets/images/Intro 2.svg" alt="foto 2" />
            </div>
            <div class="card">
                <img src="assets/images/Sign in.png" alt="foto 3" />
            </div>
            <div class="card">
                <img src="assets/images/Sign Up.png" alt="foto 4" />
            </div>
            <div class="card">
                <img src="assets/images/Home.svg" alt="foto 5" />
            </div>
            <div class="card">
                <img src="assets/images/fotodetalhevento.svg" alt="foto 6" />
            </div>
            <div class="card">
                <img src="assets/images/Ticket.svg" alt="foto 7" />
            </div>
            <div class="card">
                <img src="assets/images/Profile.svg" alt="foto 8" />
            </div>
        </div>
    </section>

    <section class="integrantes" id="integrantes">
        <img class="img-letra" src="assets/images/letrabranca.svg" alt="" />
        <h2 data-i18n="members.title">INTEGRANTES</h2>
        <div class="div-container-integrantes">
            <div class="card-integrantes">
                <img src="assets/images/foto claudio.jpeg" alt="foto-claudio" />
                <div class="logo-images">
                    <a href="https://github.com/ClaudioRodri" target="_blank">
                        <img src="assets/images/github-logo.svg" alt="logo-github" />
                    </a>
                    <a href="https://www.linkedin.com/in/claudio-rodrigues-" target="_blank">
                        <img src="assets/images/linkedin-logo.svg" alt="logo-linkedin" />
                    </a>
                </div>
            </div>

            <div class="card-integrantes">
                <img src="assets/images/foto levi.jpg" alt="foto-levi" />
                <div class="logo-images">
                    <a href="https://github.com/RedFoX1029" target="_blank">
                        <img src="assets/images/github-logo.svg" alt="logo-github" />
                    </a>
                    <a href="https://www.linkedin.com/in/levi-nicola-803037258/" target="_blank">
                        <img src="assets/images/linkedin-logo.svg" alt="logo-linkedin" />
                    </a>
                </div>
            </div>

            <div class="card-integrantes">
                <img src="assets/images/perfil.jpg" alt="foto-ryan" />
                <div class="logo-images">
                    <a href="https://github.com/0RyanSouza0" target="_blank">
                        <img src="assets/images/github-logo.svg" alt="logo-github" />
                    </a>
                    <a href="https://www.linkedin.com/in/ryan-dias-367813300/" target="_blank">
                        <img src="assets/images/linkedin-logo.svg" alt="logo-linkedin" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="container-contato">
        <div class="div-imagem">
            <img src="assets/images/sobre1.svg" alt="logo-image" class="logo-image-contato" />
        </div>

        <form action="index.php" class="div-contato">
            <p class="contate_nos" data-i18n="contact.title">Contate-nos</p>
            <p class="label-nome" data-i18n="contact.nameLabel">
                Seu nome completo
            </p>
            <input class="input-nome" placeholder="Digite seu nome" data-i18n-placeholder="contact.namePlaceholder" />

            <p class="label-email" data-i18n="contact.emailLabel">Seu Email</p>
            <input class="input-email" placeholder="Digite seu email"
                data-i18n-placeholder="contact.emailPlaceholder" />

            <p class="label-contato" data-i18n="contact.messageLabel">
                Dúvidas, sugestões ou reclamações
            </p>
            <textarea class="texto-mensagem" placeholder="Digite sua mensagem" minlength="20" maxlength="500" rows="10"
                cols="50" data-i18n-placeholder="contact.messagePlaceholder"></textarea>

            <button class="bottao-enviar" data-i18n="contact.sendButton">
                Enviar
            </button>
        </form>
    </section>

    <footer>
        <div class="informacoes">
            <span data-i18n="footer.college">FATEC - Ferraz de Vasconcelos</span>
            <span class="linha"></span>
            <span data-i18n="footer.project">Projeto Integrador</span>
            <span class="linha"></span>
            <span data-i18n="footer.year">@2025</span>
        </div>
        <div class="desenvolvido">
            <p data-i18n="footer.designer">Design By Vinicius Santos</p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script src="assets/js/script.js"></script>

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

    <script src="assets/js/traducao.js"></script>
</body>
</html>