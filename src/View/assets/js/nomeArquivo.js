const input = document.getElementById('upload');
const nomeArquivo = document.getElementById('nomeArquivo');

input.addEventListener('change', function () {
    if (input.files.length > 0) {
        const nomes = Array.from(input.files).map(arquivo => arquivo.name);
        nomeArquivo.textContent = `Arquivos: ${nomes.join(', ')}`;
    } else {
        nomeArquivo.textContent = 'Nenhum arquivo selecionado';
    }
});
