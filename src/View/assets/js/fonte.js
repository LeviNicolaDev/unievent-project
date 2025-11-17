document.addEventListener("DOMContentLoaded", () => {
  const tamanhoFonte = localStorage.getItem("tamanhoFonte");
  if (tamanhoFonte) {
    document.documentElement.style.fontSize = tamanhoFonte;
  }
});

function definirFonteGrande() {
  const novoTamanho = "20px";
  localStorage.setItem("tamanhoFonte", novoTamanho);
  document.documentElement.style.fontSize = novoTamanho;
}

function redefinirFonte() {
  localStorage.removeItem("tamanhoFonte");
  document.documentElement.style.fontSize = "16px";
}
