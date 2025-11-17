const translations = {
    en: {
        welcome: "Welcome!",
        login_prompt_line1: "Log in with your credentials",
        login_prompt_line2: "to start the experience",
        login_button: "Login",
        create_account: "Create Account",
        use_institutional_email: "Use your institutional email",
        name_placeholder: "Name",
        email_label: "Email",
        email_placeholder: "Institutional Email",
        password_label: "Password",
        password_placeholder: "Password",
        register_button: "Register",
        hello: "Hello!",
        connect_prompt_line1: "To connect with us",
        connect_prompt_line2: "please register first",
        login_to_start: "Login to start",
        forgot_password: "Forgot my password",
        enter: "Enter"
    },
    pt: {
        welcome: "Bem-Vindo!",
        login_prompt_line1: "Entre com seus dados de login",
        login_prompt_line2: "para começar a experiência",
        login_button: "Entrar",
        create_account: "Criar conta",
        use_institutional_email: "Utilize seu email institucional",
        name_placeholder: "Nome",
        email_label: "E-mail",
        email_placeholder: "Email Institucional",
        password_label: "Senha",
        password_placeholder: "Senha",
        register_button: "Cadastrar",
        hello: "Olá!",
        connect_prompt_line1: "Para se conectar a nós",
        connect_prompt_line2: "por favor, faça o cadastro",
        login_to_start: "Entre para iniciar",
        forgot_password: "Esqueci minha senha",
        enter: "Entrar"
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
