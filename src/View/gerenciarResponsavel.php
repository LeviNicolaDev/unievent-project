<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <title>UniEvent</title>
</head>

<body>
    <header>
        <img src="assets/images/logo3.png" alt="" class="logo">
        <p>Gerenciar Usuarios</p>
    </header>

    <form action="/UniEvent-Project/public/index.php?action=updateResponsavel" class="campos-3" method="post" enctype="multipart/form-data">

        <input type="hidden" name="id" value="1" />

        <label>Nome: </label>
        <input type="text" name="nome" class="input-res" required />

        <label>Foto de Perfil: </label>
        <input type="file" name="fotoPerfil" class="input-res" accept="image/*" />

        <input type="submit" value="Enviar">
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            form.addEventListener("submit", function (e) {
                window.alert("Responsável Atualizado com Sucesso!");
            });
        });
    </script>
    
</body>
</html>