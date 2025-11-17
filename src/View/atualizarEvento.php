<?php 
// Supondo que $evento esteja definido corretamente
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/UniEvent-Project/src/View/assets/css/styleAtualizarEvento.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title data-i18n="update_event">Atualizar Evento</title>
</head>

<body>
    <header>
        <div class="container-logo">
            <img src="/Unievent-Project/src/View/assets/images/logo3.png" alt="" class="logo">
            <p data-i18n="update_event">Atualizar Evento</p>
        </div>
        <a href="/UniEvent-Project/public/index.php?action=listarEventos" class="b-voltar">
            <i class="fa-solid fa-arrow-left"></i>
            <span data-i18n="back" style="border:none;">Voltar</span>
        </a>
    </header>

    <form id="formEdicao" method="post" enctype="multipart/form-data">
        <div class="campos">
            <div class="campos-1">
                <p class="titulos" data-i18n="title">Título</p>
                <div class="input-container-titulo">
                    <input type="text" name="titulo" class="input-titulo" value="<?= htmlspecialchars($evento['nome']); ?>"
                        data-i18n-placeholder="title_placeholder" placeholder="Digite o título" />
                </div>
                <p class="titulos" data-i18n="description">Descrição</p>
                <div class="input-container-desc">
                    <textarea class="input-desc" name="descricao" required data-i18n-placeholder="desc_placeholder"
                        placeholder="Digite a descrição"><?= htmlspecialchars($evento['descricao']); ?></textarea>
                </div>
                <p class="titulos" data-i18n="capacity">Capacidade</p>
                <div class="input-container-cap">
                    <input type="number" name="capacidade" class="input-cap" placeholder="N° máximo de pessoas"
                        value="<?= htmlspecialchars($evento['capacidade']); ?>" data-i18n-placeholder="capacity_placeholder" />
                </div>
            </div>
            <div class="campos-2">
                <p class="titulos" data-i18n="responsible">Responsável</p>
                <div class="input-container-res">
                    <select name="responsavel" class="input-res" id="responsavel" required>
                        <option value="">Selecione um responsável</option>
                        <?php if (isset($responsaveis) && !empty($responsaveis)): ?>
                            <?php foreach ($responsaveis as $responsavel): ?>
                                <option value="<?= $responsavel['id'] ?>" 
                                    <?= ($evento['id_responsavel_evento_fk'] == $responsavel['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($responsavel['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Nenhum responsável cadastrado</option>
                        <?php endif; ?>
                    </select>
                </div>
                <p class="titulos" data-i18n="image">Imagem</p>
                <div class="input-container-img">
                    <input type="file" name='thumbnail' id="upload" accept="image/*" />
                    <label for="upload" class="upload-label">
                        <img class="img-upload"
                            style="width:290px; max-height: 140px; object-fit:cover; border-radius:10px;"
                            src="/UniEvent-Project/public<?= htmlspecialchars($evento['thumbnail']) ?>"
                            id="preview" />
                    </label>
                </div>
                <div class="input-container-data">
                    <p class="titulos" data-i18n="date">Data</p>
                    <input type="date" name="dataEvento" class="input-data" value="<?= htmlspecialchars($evento['data_evento']) ?>" />
                </div>
            </div>
            <div>
                <div class="input-container-hora">
                    <p class="titulos" data-i18n="time">Hora</p>
                    <input type="time" name="horaEvento" class="input-hora" value="<?= htmlspecialchars($evento['hora_evento']) ?>" />
                </div>
                <p class="titulos" data-i18n="event_type">Tipo de Evento</p>
                <div class="input-container-res">
                    <select name="categoriaEvento" class="input-res">
                        <option value="Palestra">Palestra</option>
                    </select>
                </div>
                <div class="container-botão">
                    <button type="submit" data-i18n="update_event"
                        onclick="confirmaAtualizacao(<?= $evento['id'] ?>);event.preventDefault()">Atualizar
                        Evento</button>
                </div>
            </div>
        </div>
        <div id="modal" class="modal" style="display: none">
            <div class="content-modal">
                <p id="conteudo" data-i18n="update">Tem certeza que deseja atualizar este evento?</p>
                <i class="fa-solid fa-triangle-exclamation" id="emote"></i>
                <input type="hidden" name="action" value="editarEvento" />
                <input type="hidden" name="id" id="idEventoParaEditar" />
                <div class="align-btn">
                    <button type="submit" id="btn-modal" data-i18n="btn_confirm">Confirmar</button>
                    <button type="button" id="btn-modal" data-i18n="btn_cancel" onclick="fecharModalEdicao()">
                        Cancelar
                    </button>
                </div>

            </div>
        </div>

    </form>

    <script>
        const modal = document.getElementById("modal");
        const formulario = document.getElementById("formulario");
        const emoteError = document.getElementById("emote");
        const conteudo = document.getElementById("conteudo");
        const btnModal = document.getElementById("btnmodal");

        function confirmaAtualizacao(idEvento) {
            document.getElementById("idEventoParaEditar").value = idEvento;

            document.getElementById(
                "formEdicao"
            ).action = `/UniEvent-Project/public/index.php?action=atualizarEvento&id=<?= $evento['id'] ?>`;

            document.getElementById("modal").style.display = "flex";
        }

        function fecharModalEdicao() {
            document.getElementById("modal").style.display = "none";
        }
    </script>

    <script src="assets/js/buttonTiposEvento.js"></script>

    <script src="https://kit.fontawesome.com/1c065add65.js" crossorigin="anonymous"></script>

    <script>
        const input = document.getElementById('upload');
        const preview = document.getElementById('preview');

        input.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    preview.setAttribute('src', this.result);
                    preview.style.display = 'block';
                    preview.style.minHeight = '140px';
                    preview.style.objectFit = 'cover';
                    preview.style.borderRadius = '10px';
                });

                reader.readAsDataURL(file);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
            }

            const translations = {
                en: {
                    update_event: "Update Event",
                    back: "Back",
                    title: "Title",
                    description: "Description",
                    capacity: "Capacity",
                    responsible: "Responsible",
                    image: "Image",
                    date: "Date",
                    time: "Time",
                    event_type: "Event Type",
                    title_placeholder: "Enter title",
                    desc_placeholder: "Enter description",
                    capacity_placeholder: "Max number of people",
                    update: "Are you sure you want to update this event?",
                    btn_confirm: "Confirm",
                    btn_cancel: "Cancel"
                },
                pt: {
                    update_event: "Atualizar Evento",
                    back: "Voltar",
                    title: "Título",
                    description: "Descrição",
                    capacity: "Capacidade",
                    responsible: "Responsável",
                    image: "Imagem",
                    date: "Data",
                    time: "Hora",
                    event_type: "Tipo de Evento",
                    title_placeholder: "Digite o título",
                    desc_placeholder: "Digite a descrição",
                    capacity_placeholder: "N° máximo de pessoas",
                    update: "Tem certeza que deseja atualizar este evento?",
                    btn_confirm: "Confirmar",
                    btn_cancel: "Cancelar"
                }
            };

            const lang = localStorage.getItem('lang') || 'pt';

            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[lang][key]) {
                    el.textContent = translations[lang][key];
                }
            });

            document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (translations[lang][key]) {
                    el.placeholder = translations[lang][key];
                }
            });
        });
    </script>

</body>
</html>