const translations = {
    en: {
        greeting: "Hello, " + nomeUsuario,
        manage_units: "Manage Units",
        support: "Support",
        logout: "Logout",
        create_event: "Create Event",
        manage_events: "Manage Events",
        manage_people: "Manage People",
        create_responsible: "Create Responsible",
        manage_certificates: "Manage Certificates"
    },
    pt: {
        greeting: "Olá, " + nomeUsuario,
        manage_units: "Gerenciar Unidades",
        support: "Suporte",
        logout: "Sair",
        create_event: "Criar Evento",
        manage_events: "Gerenciar Eventos",
        manage_people: "Gerenciar Pessoas",
        create_responsible: "Criar Responsável",
        manage_certificates: "Gerenciar Certificados"
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
}

document.addEventListener("DOMContentLoaded", function () {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark-mode");
    }

    const savedLang = localStorage.getItem("lang") || "pt";
    setLanguage(savedLang);
});
