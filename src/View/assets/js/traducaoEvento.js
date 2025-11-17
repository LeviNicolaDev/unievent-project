const translations = {
    en: {
        create_event_title: "Create Event",
        back_button: "Back",
        label_title: "Title",
        label_description: "Description",
        label_capacity: "Capacity",
        placeholder_capacity: "Max number of people",
        label_responsible: "Responsible",
        label_image: "Image",
        label_date: "Date",
        label_time: "Time",
        label_event_type: "Event Type",
        preview_button: "Preview"
    },
    pt: {
        create_event_title: "Criar Evento",
        back_button: "Voltar",
        label_title: "Título",
        label_description: "Descrição",
        label_capacity: "Capacidade",
        placeholder_capacity: "N° máximo de pessoas",
        label_responsible: "Responsável",
        label_image: "Imagem",
        label_date: "Data",
        label_time: "Hora",
        label_event_type: "Tipo de Evento",
        preview_button: "Ver Prévia"
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