<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/styleSuporte.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title data-i18n="support">Suporte</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="assets/images/logo3.png" alt="" class="logo" />
            <p data-i18n="support">Suporte</p>
        </div>
        <a href="./home.php" class="b-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            <span data-i18n="back">Voltar</span>
        </a>
    </header>

    <div class="btn">
        <p data-i18n="light_mode">Modo Claro</p>
        <label class="switch">
            <input type="checkbox" id="themeSwitch" />
            <span class="slider"></span>
        </label>
    </div>
    <div class="language-buttons">
        <button onclick="setLanguage('pt')" data-i18n="lang_pt">Português</button>
        <button onclick="setLanguage('en')" data-i18n="lang_en">English</button>
    </div>

    <script src="assets/js/modoClaro.js"></script>
    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>
    <script>
    const translations = {
        en: {
            support: "Support",
            back: "Back",
            light_mode: "Light Mode",
            lang_pt: "Portuguese",
            lang_en: "English",
        },
        pt: {
            support: "Suporte",
            back: "Voltar",
            light_mode: "Modo Claro",
            lang_pt: "Português",
            lang_en: "Inglês",
        },
    };

    function setLanguage(lang) {
        localStorage.setItem("lang", lang);
        translatePage(lang);
    }

    function translatePage(lang) {
        document.querySelectorAll("[data-i18n]").forEach((el) => {
            const key = el.getAttribute("data-i18n");
            if (translations[lang][key]) {
                el.textContent = translations[lang][key];
            }
        });

        document.querySelectorAll("[data-i18n-placeholder]").forEach((el) => {
            const key = el.getAttribute("data-i18n-placeholder");
            if (translations[lang][key]) {
                el.placeholder = translations[lang][key];
            }
        });
    }

    // Executa ao carregar
    document.addEventListener("DOMContentLoaded", () => {
        const lang = localStorage.getItem("lang") || "pt";
        translatePage(lang);
    });
    </script>
</body>

</html>