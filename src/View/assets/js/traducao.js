
const translations = {
    pt: {
        "nav.about": "Sobre",
        "nav.app": "Aplicativo",
        "nav.members": "Integrantes",
        "nav.login": "Login",
        "header.slogan": "DESCUBRA, CONECTE E PARTICIPE!",
        "header.description": " O UniEvent é um aplicativo desenvolvido com o objetivo de ser um gerenciador de eventos institucionais, voltado principalmente para universidades, faculdades e outras instituições de ensino...",
        "header.button": "Ver Mais",
        "app.title": "TELAS",
        "members.title": "INTEGRANTES",
        "contact.title": "Contate-nos",
        "contact.nameLabel": "Seu nome completo",
        "contact.namePlaceholder": "Digite seu nome",
        "contact.emailLabel": "Seu Email",
        "contact.emailPlaceholder": "Digite seu email",
        "contact.messageLabel": "Dúvidas, sugestões ou reclamações",
        "contact.messagePlaceholder": "Digite sua mensagem",
        "contact.sendButton": "Enviar",
        "footer.college": "FATEC - Ferraz de Vasconcelos",
        "footer.project": "Projeto Integrador",
        "footer.year": "@2025",
        "footer.designer": "Design By Vinicius Santos",
    },
    en: {
        "nav.about": "About",
        "nav.app": "App",
        "nav.members": "Members",
        "nav.login": "Login",
        "header.slogan": "DISCOVER, CONNECT, AND PARTICIPATE!",
        "header.description": "UniEvent is an app developed to manage institutional events, primarily aimed at universities, colleges, and other educational institutions. It allows users, such as organizers and participants, to efficiently manage, track, and take part in events in a practical and organized way.",
        "header.button": "See More",
        "app.title": "SCREENS",
        "members.title": "MEMBERS",
        "contact.title": "Contact Us",
        "contact.nameLabel": "Your Full Name",
        "contact.namePlaceholder": "Enter your name",
        "contact.emailLabel": "Your Email",
        "contact.emailPlaceholder": "Enter your email",
        "contact.messageLabel": "Questions, suggestions or complaints",
        "contact.messagePlaceholder": "Enter your message",
        "contact.sendButton": "Send",
        "footer.college": "FATEC - Ferraz de Vasconcelos",
        "footer.project": "Integration Project",
        "footer.year": "@2025",
        "footer.designer": "Design By Vinicius Santos",
    }
};

function setLanguage(lang) {
    localStorage.setItem("lang", lang);
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

document.addEventListener("DOMContentLoaded", () => {
    const savedLang = localStorage.getItem("lang") || "pt";
    setLanguage(savedLang);
});
