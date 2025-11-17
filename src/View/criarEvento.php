<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/UniEvent-Project/src/View/assets/css/styleCriarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title>Criar Evento</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/UniEvent-Project/src/View/assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="create_event_title">Criar Evento</p>
        </div>
        <a href="/UniEvent-Project/src/View/home.php" class="b-voltar"><i class="fa-solid fa-arrow-left"></i><span data-i18n="back_button"
                style="border:none;">Voltar</span></a>
    </header>

    <form action="/UniEvent-Project/public/index.php?action=processarEvento" method="post" enctype="multipart/form-data"
        id="formulario">
        <div class="campos">
            <div class="campos-1">
                <p class="titulos" data-i18n="label_title">Título</p>
                <div class="input-container-titulo">
                    <input type="text" name="titulo" id="titulo" class="input-titulo" />
                </div>

                <p class="titulos" data-i18n="label_description">Descrição</p>
                <div class="input-container-desc">
                    <textarea class="input-desc" id="descricao" name="descricao"></textarea>
                </div>

                <p class="titulos" data-i18n="label_capacity">Capacidade</p>
                <div class="input-container-cap">
                    <input type="number" name="capacidade" id="capacidade" placeholder="N° máximo de pessoas"
                        class="input-cap" data-i18n-placeholder="placeholder_capacity" />
                </div>
            </div>

            <div class="campos-2">
                <p class="titulos" data-i18n="label_responsible">Responsável</p>
                <div class="input-container-res">
                    <select name="responsavel" id="responsavel" class="input-res" required>
                        <option value="">Selecione um responsável</option>
                        <?php if (isset($responsaveis) && !empty($responsaveis)): ?>
                            <?php foreach ($responsaveis as $responsavel): ?>
                                <option value="<?= $responsavel['id'] ?>">
                                    <?= htmlspecialchars($responsavel['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Nenhum responsável cadastrado</option>
                        <?php endif; ?>
                    </select>
                </div>

                <p class="titulos" data-i18n="label_image">Imagem</p>
                <div class="input-container-img">
                    <input type="file" name="thumbnail" id="upload" accept="image/*" />
                    <label for="upload" class="upload-label">
                        <input type="hidden" />
                        <img class="img-upload" src="/UniEvent-Project/src/View/assets/images/upload.png" id="preview" />
                    </label>
                </div>

                <p id="nomeArquivo" class="nomeArquivo"></p>

                <div class="input-container-data">
                    <p class="titulos" data-i18n="label_date">Data</p>
                    <input type="date" name="dataEvento" id="data" class="input-data" />
                </div>
            </div>

            <div>
                <div class="input-container-hora">
                    <p class="titulos" data-i18n="label_time">Hora</p>
                    <input type="time" name="horaEvento" id="hora" class="input-hora" />
                </div>

                <p class="titulos" data-i18n="label_event_type">Tipo de Evento</p>
                <div class="input-container-res">
                    <select name="categoriaEvento" id="tipoEvento" class="input-res">
                        <option value="Palestra">Palestra</option>
                    </select>
                </div>
            </div>

        </div>
        </div>
        <div class="container-modal" id="modal">
            <div class="content-modal">
                <button type="reset" id="btn-fechar"><i class="fa-solid fa-xmark"></i></button>
                <img src="/UniEvent-Project/src/View/assets/images/warning.png" id="emote">
                <p id="conteudo" data-i18n="create"> Tem certeza que deseja criar o evento?</p>
                <p id="conteudo2" data-i18n="fills"> Preencha todos os campos ou verifique se a data ou a hora é valida.
                </p>
                <button type="submit" id="btnmodal" data-i18n="btn_create">Criar</button>
            </div>
        </div>

    </form>
    <div class="container-botão">
        <button type="submit" data-i18n="preview_button" id="btn" onclick="validaform();">
            Criar Evento
        </button>
    </div>



    <script src="/UniEvent-Project/src/View/assets/js/buttonTiposEvento.js"></script>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script>
        const btn = document.getElementById("btn");
        const modal = document.getElementById("modal");
        const formulario = document.getElementById("formulario");
        const emoteError = document.getElementById("emote");
        const emoteAcess = document.getElementById("emoteAcess");
        var titulo = document.getElementById("titulo");
        var descricao = document.getElementById("descricao");
        var hora = document.getElementById("hora");
        var tipoEvento = document.getElementById("tipoEvento");
        var imagem = document.getElementById("upload");
        var responsavel = document.getElementById("responsavel");
        var data = document.getElementById("data");
        var capacidade = document.getElementById("capacidade");
        const conteudo = document.getElementById("conteudo");
        const btnModal = document.getElementById("btnmodal");

        // Função para aplicar tema ao select de responsável
        function aplicarTemaSelect() {
            const selectResponsavel = document.getElementById("responsavel");
            const isDarkMode = document.body.classList.contains("dark-mode");
            
            if (isDarkMode) {
                // Modo escuro: fundo preto com letras brancas
                selectResponsavel.style.color = "#272727";
                selectResponsavel.style.backgroundColor = "#fff";
                // Aplicar estilo às opções
                const options = selectResponsavel.querySelectorAll("option");
                options.forEach(option => {
                    option.style.color = "#272727";
                    option.style.backgroundColor = "#fff";
                });
            } else {
                // Modo claro: fundo branco com letras pretas
                selectResponsavel.style.color = "#fff";
                selectResponsavel.style.backgroundColor = "#272727";
                // Aplicar estilo às opções
                const options = selectResponsavel.querySelectorAll("option");
                options.forEach(option => {
                    option.style.color = "#fff";
                    option.style.backgroundColor = "#272727";
                });
            }
        }

        const dataString = data;

        function validaData(dataRecebida) {
            var dataAux = dataRecebida.split("/");
            var ano = parseInt(dataAux[0]);
            var mes = parseInt(dataAux[1]);
            var dia = parseInt(dataAux[2]);

            if (mes > 12 || mes <= 0) {
                return false;
            } else if (dia > 31 || mes <= 0) {
                return false;
            } else if (dia >= 30 && mes == 2) {
                return false;
            } else if (dia == 29 && mes == 2 && (ano % 4) != 0) {
                return false;
            } else if (dia == 31 && mes == 2 || (mes == 4) || (mes == 6) || (mes == 9) || (mes == 11)) {
                return false;
            } else {
                return true;
            }
        }

        function validaHora(horaRecebida) {
            var horaAux = horaRecebida.split(":");
            var hora = parseInt(horaAux[0]);
            var minutos = parseInt(horaAux[1]);

            if (hora > 24 || hora < 0) {
                return false;
            } else if (minutos > 59 || minutos < 0) {
                return false;

            } else {
                return true;
            }
        }

        function validaform() {
            if (
                titulo.value.trim() === "" ||
                descricao.value.trim() === "" ||
                upload.value.trim() === "" ||
                responsavel.value.trim() === "" ||
                capacidade.value.trim() === "" ||
                data.value.trim() === "" ||
                hora.value.trim() === "" ||
                tipoEvento.value.trim() === "" ||
                validaData(data.value.trim()) === false ||
                validaHora(hora.value.trim()) === false
            ) {
                const modal = document.getElementById('modal');
                const conteudo = document.getElementById('conteudo');
                const conteudo2 = document.getElementById('conteudo2');

                modal.style.display = 'flex';
                modal.style.position = 'fixed';
                btnModal.style.display = 'none';
                emote.style.display = 'flex';
                emote.src = '/UniEvent-Project/src/View/assets/images/emoteError.png';
                conteudo2.style.textAlign = 'center';
                conteudo2.style.display = 'flex';
                conteudo.style.display = 'none';
                formulario.reset();
                return false;
            } else {
                const modal = document.getElementById('modal');

                const conteudo2 = document.getElementById('conteudo2');
                const conteudo = document.getElementById('conteudo');

                modal.style.display = 'flex';
                emote.style.display = 'flex';
                emote.src = '/UniEvent-Project/src/View/assets/images/emoteAcess.png';
                btnModal.style.display = 'block';
                modal.style.position = 'fixed';
                conteudo.style.display = 'flex';
                conteudo2.style.display = 'none';

                conteudo.style.textAlign = 'center';

                return true;
            }
        }
        const btnFechar = document.getElementById("btn-fechar");
        btnFechar.onclick = function() {
            formulario.reset();
            modal.style.display = "none";
        }
    </script>

    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
    new window.VLibras.Widget("https://vlibras.gov.br/app");
    </script>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
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
            preview_button: "Create Event",
            create: "Are you sure to create this event?",
            fills: "Fill in all the fields or check that the date or time is valid.",
            btn_create: "Create"
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
            preview_button: "Criar Evento"
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

    // Imagem upload preview
    const input = document.getElementById("upload");
    const preview = document.getElementById("preview");
    const nomeArquivo = document.getElementById("nomeArquivo");

    input.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                preview.setAttribute("src", this.result);
                preview.style.display = "block";
                preview.style.width = "290px";
                preview.style.maxHeight = "140px";
                preview.style.objectFit = "cover";
                preview.style.borderRadius = "10px";
            });
            reader.readAsDataURL(file);
        }

        if (input.files.length > 0) {
            const nomes = Array.from(input.files).map(
                (arquivo) => arquivo.name
            );
            nomeArquivo.textContent = `Arquivos: ${nomes.join(",")}`;
        } else {
            nomeArquivo.textContent = "Nenhum arquivo selecionado";
        }
    });

        document.addEventListener("DOMContentLoaded", function() {
            const savedTheme = localStorage.getItem("theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-mode");
            }

            const savedLang = localStorage.getItem("lang") || "pt";
            setLanguage(savedLang);
            
            // Aplicar tema ao select de responsável
            aplicarTemaSelect();
            
            // Observer para detectar mudanças no tema
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        aplicarTemaSelect();
                    }
                });
            });
            
            observer.observe(document.body, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
</body>

</html>