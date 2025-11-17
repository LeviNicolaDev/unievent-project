<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <title>Tabela de Eventos</title>
    <link rel="stylesheet" href="/Unievent-Project/src/View/assets/css/styleGerenciarEvento.css" />
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/UniEvent-Project/src/View/assets/images/logo3.png" alt="Logo" class="logo" />
            <p data-i18n="event_list_heading">Listagem de Eventos</p>
        </div>
        <a href="/UniEvent-Project/src/View/home.php">
            <i class="fa-solid fa-arrow-left"></i>
            <span data-i18n="back_button">Voltar</span>
        </a>
    </header>

    <table>
        <thead>
            <tr>
                <th data-i18n="table_id">ID</th>
                <th data-i18n="table_title">Título</th>
                <th data-i18n="table_responsible">Responsável</th>
                <th data-i18n="table_event_type">Tipo de Evento</th>
                <th data-i18n="table_date">Data</th>
                <th data-i18n="table_time">Hora</th>
                <th data-i18n="table_image">Imagem</th>
                <th data-i18n="table_description">Descrição</th>
                <th data-i18n="table_capacity">Capacidade</th>
                <th data-i18n="table_actions">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($eventos)): ?>
            <tr>
                <td colspan="10" style="text-align: center" data-i18n="no_events">
                    Nenhum evento encontrado
                </td>
            </tr>
            <?php else: ?>
            <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?= htmlspecialchars($evento['id']) ?></td>
                <td><?= htmlspecialchars($evento['nome']) ?></td>
                <td>
                    <?php if (!empty($evento['responsavel_nome'])): ?>
                        <?= htmlspecialchars($evento['responsavel_nome']) ?>
                    <?php else: ?>
                        <span data-i18n="no_responsible">Sem responsável</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($evento['categoria_evento']) ?></td>
                <td><?= htmlspecialchars($evento['data_evento']) ?></td>
                <td><?= htmlspecialchars($evento['hora_evento']) ?></td>
                <td>
                    <?php if (!empty($evento['thumbnail'])): ?>
                    <img src="/UniEvent-Project/public<?= htmlspecialchars($evento['thumbnail']) ?>" alt="Thumbnail"
                        style="width: 100px" />
                    <?php else: ?>
                    <span data-i18n="no_image">Sem imagem</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($evento['descricao']) ?></td>
                <td><?= htmlspecialchars($evento['capacidade']) ?></td>
                <td class="acoes">
                    <a class="botao-acao" title="Editar"
                        href="/UniEvent-Project/public/index.php?action=visualizarAtualizarEvento&id=<?= $evento['id'] ?>">
                        <i class="fa-solid fa-file-pen"></i>
                    </a>

                    <a class="botao-acao" title="Excluir" onclick="confirmaExclusao(<?= $evento['id'] ?>)"
                        href="javascript:void(0);">
                        <i class="fa-solid fa-trash"></i>
                    </a>

                    <a class="botao-acao" title="Visualizar Preview" href="/UniEvent-Project/src/View/previaEvento.php">
                        <img src="/Unievent-Project/src/View/assets/images/previewIcon.svg" alt="" srcset="" />
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <div id="modal" class="modal" style="display: none">
        <div class="content-modal">
            <p id="conteudo" data-i18n="are_sure">Tem certeza que deseja excluir este evento?</p>
            <i class="fa-solid fa-triangle-exclamation" id="emote"></i>

            <form method="GET" id="formExclusao">
                <input type="hidden" name="action" value="excluirEvento" />
                <input type="hidden" name="id" id="idEventoParaExcluir" />
                <button type="submit" id="btn-modal" data-i18n="btn_confirm">Confirmar</button>
                <button type="button" id="btn-modal" data-i18n="btn_cancel" onclick="fecharModalExclusao()">
                    Cancelar
                </button>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
        const btn = document.getElementById("btn");
        const modal = document.getElementById("modal");
        const formulario = document.getElementById("formulario");
        const emoteError = document.getElementById("emote");
        const emoteAcess = document.getElementById("emoteAcess");

        const conteudo = document.getElementById("conteudo");
        const btnModal = document.getElementById("btnmodal");

        function confirmaExclusao(idEvento) {
            document.getElementById("idEventoParaExcluir").value = idEvento;

            document.getElementById(
                "formExclusao"
            ).action = `/UniEvent-Project/public/index.php`;

            document.getElementById("modal").style.display = "flex";
            emoteError.src = "assets/images/warning.jpg";
        }

        function fecharModalExclusao() {
            document.getElementById("modal").style.display = "none";
        }
        
    </script>

    <script>
        const translations = {
            en: {
                event_table_title: "Event Table",
                event_list_heading: "Event Listing",
                back_button: "Back",
                table_id: "ID",
                table_title: "Title",
                table_responsible: "Responsible",
                table_event_type: "Event Type",
                table_date: "Date",
                table_time: "Time",
                table_image: "Image",
                table_description: "Description",
                table_capacity: "Capacity",
                table_actions: "Actions",
                no_events: "No events found",
                no_image: "No image",
                no_responsible: "No responsible",
                are_sure: "Are you sure you want to delete this event?",
                btn_confirm: "Confirm",
                btn_cancel: "Cancel"
            },
            pt: {
                event_table_title: "Tabela de Eventos",
                event_list_heading: "Listagem de Eventos",
                back_button: "Voltar",
                table_id: "ID",
                table_title: "Título",
                table_responsible: "Responsável",
                table_event_type: "Tipo de Evento",
                table_date: "Data",
                table_time: "Hora",
                table_image: "Imagem",
                table_description: "Descrição",
                table_capacity: "Capacidade",
                table_actions: "Ações",
                no_events: "Nenhum evento encontrado",
                no_image: "Sem imagem",
                no_responsible: "Sem responsável",
                are_sure: "Tem certeza que deseja excluir este evento?",
                btn_confirm: "Confirmar",
                btn_cancel: "Cancelar"
            },
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

        document.addEventListener("DOMContentLoaded", function() {
            const savedTheme = localStorage.getItem("theme");
            if (savedTheme === "dark") {
                document.body.classList.add("dark-mode");
            }
            const savedLang = localStorage.getItem("lang") || "pt";
            setLanguage(savedLang);
        });
    </script>

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
    
</body>
</html>