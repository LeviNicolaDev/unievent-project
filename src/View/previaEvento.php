<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title data-i18n="event_preview">Prévia do Evento</title>
    <link rel="stylesheet" href="assets/css/stylePreviaEvento.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="create_event_title">Preview</p>
        </div>
        <a href="/Unievent-Project/public/index.php?action=listarEventos" class="b-voltar"><i
                class="fa-solid fa-arrow-left"></i><span data-i18n="back_button" style="border:none;">Voltar</span></a>
    </header>

    <div class="container-app">
        <div class="tela">
            <div class="header-app">
                <img src="assets/images/voltar.png" class="icones" />
                <img src="assets/images/favorito.png" class="icones" />
            </div>

            <img src="assets/images/evento.png" alt="evento" class="imgEvento" />

            <h1>The Rock - 5ºEdição</h1>

            <div class="informações">
                <div class="local">
                    <img src="assets/images/local.png" class="icones" />
                    <p>Fatec Feraz de Vasconcelos</p>
                </div>
                <div class="container-data-hora">
                    <div class="data">
                        <img src="assets/images/calendario.png" class="icones" />
                        <p>25/01/2026</p>
                    </div>
                    <div class="linhadivisao-1"></div>
                    <div class="hora">
                        <img src="assets/images/relogio.png" class="icone-relogio" />
                        <p>19:00</p>
                    </div>
                </div>
                <br />
                <div class="tipo">
                    <img src="assets/images/tipo.png" class="icones" />
                    <p data-i18n="music">Música</p>
                </div>
            </div>

            <div class="container">
                <p class="organizador" data-i18n="organizer">Organizador</p>
                <div class="info-unidade">
                    <img src="assets/images/tipo.png" class="icones" />
                    <p>Fatec Ferraz de Vasconcelos</p>
                    <button data-i18n="learn_more">Saiba Mais</button>
                </div>

                <div class="linhadivisao-2"></div>
                <div class="descrição">
                    <h1 data-i18n="about_event">Sobre o evento</h1>
                    <p data-i18n="event_description">
                        Nosso tão esperado TeckRock acontece amanhã aqui na unidade!
                        🎸🤘<br /><br />
                        Um show incrível de rock com a banda formada por alunos dos cursos
                        de GPI, ADS e GE!<br /><br />
                        Entrada gratuita, mas pedimos a doação de produtos de higiene
                        (fraldas, absorventes, pasta de dente, escova de dente, lenço
                        umedecido).<br /><br />
                        Solidariedade: Todos os itens arrecadados serão doados à ONG
                        ECAC/Pé de Pitanga, ajudando crianças e mulheres em situação de
                        vulnerabilidade
                    </p>
                </div>

                <div class="button-reservar">
                    <button data-i18n="get_ticket">GARANTIR INGRESSO</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    new window.VLibras.Widget("https://vlibras.gov.br/app");
    </script>

    <script>
    function setLanguage(lang) {
        localStorage.setItem("lang", lang);
        location.reload();
    }

    document.addEventListener("DOMContentLoaded", function() {
        const savedTheme = localStorage.getItem("theme");
        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
        }

        const lang = localStorage.getItem("lang") || "pt";

        const translations = {
            pt: {
                event_preview: "Prévia do Evento",
                music: "Música",
                organizer: "Organizador",
                learn_more: "Saiba Mais",
                about_event: "Sobre o evento",
                event_description: `Nosso tão esperado TeckRock acontece amanhã aqui na unidade! 🎸🤘<br /><br />
              Um show incrível de rock com a banda formada por alunos dos cursos de GPI, ADS e GE!<br /><br />
              Entrada gratuita, mas pedimos a doação de produtos de higiene
              (fraldas, absorventes, pasta de dente, escova de dente, lenço umedecido).<br /><br />
              Solidariedade: Todos os itens arrecadados serão doados à ONG ECAC/Pé de Pitanga, ajudando crianças e mulheres em situação de vulnerabilidade`,
                get_ticket: "GARANTIR INGRESSO",
                edit: "Alterar",
                create: "Criar",
            },
            en: {
                event_preview: "Event Preview",
                music: "Music",
                organizer: "Organizer",
                learn_more: "Learn More",
                about_event: "About the Event",
                event_description: `Our long-awaited TeckRock happens tomorrow at the campus! 🎸🤘<br /><br />
              An amazing rock concert with a band formed by students from GPI, ADS, and GE!<br /><br />
              Free entry, but we ask for donations of hygiene products
              (diapers, sanitary pads, toothpaste, toothbrushes, wet wipes).<br /><br />
              Solidarity: All donated items will go to the NGO ECAC/Pé de Pitanga to help children and women in vulnerable situations.`,
                get_ticket: "GET TICKET",
                edit: "Edit",
                create: "Create",
            },
        };

        document.querySelectorAll("[data-i18n]").forEach((el) => {
            const key = el.getAttribute("data-i18n");
            if (translations[lang][key]) {
                if (key === "event_description") {
                    el.innerHTML = translations[lang][key];
                } else {
                    el.textContent = translations[lang][key];
                }
            }
        });
    });
    </script>
</body>

</html>