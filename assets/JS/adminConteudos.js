document.addEventListener("DOMContentLoaded", () => {

    const pesquisarConteudoAdmin = document.getElementById("pesquisarConteudoAdmin");
    const listaConteudosAdmin = document.getElementById("listaConteudosAdmin");
    const nenhumResultado = document.getElementById("nenhumResultado");

    if (pesquisarConteudoAdmin && listaConteudosAdmin) {

        pesquisarConteudoAdmin.addEventListener("input", () => {

            const busca = pesquisarConteudoAdmin.value.toLowerCase().trim();
            const linhas = listaConteudosAdmin.querySelectorAll("tr");

            let encontrados = 0;

            linhas.forEach((linha) => {

                const titulo = linha.querySelector(".titulo-conteudo-admin");

                if (!titulo) return;

                const textoTitulo = titulo.innerText.toLowerCase();

                if (textoTitulo.includes(busca)) {
                    linha.style.display = "";
                    encontrados++;
                } else {
                    linha.style.display = "none";
                }

            });

            if (nenhumResultado) {
                nenhumResultado.style.display = encontrados === 0 ? "block" : "none";
            }

        });

    }

    const imagemConteudo = document.getElementById("imagemConteudo");
    const previewConteudo = document.getElementById("previewConteudo");
    const btnImagem = document.getElementById("btnImagemConteudo");
    const textoImagem = document.querySelector("#btnImagemConteudo span");

    if (imagemConteudo && previewConteudo && btnImagem) {

        imagemConteudo.addEventListener("change", () => {

            const arquivo = imagemConteudo.files[0];

            if (!arquivo) return;

            btnImagem.classList.add("selecionado");

            if (textoImagem) {

                textoImagem.textContent =
                    arquivo.name.length > 15
                    ? arquivo.name.substring(0, 15) + "..."
                    : arquivo.name;
            }

            const reader = new FileReader();

            reader.onload = (e) => {
                previewConteudo.innerHTML = `
                    <img src="${e.target.result}" class="preview-admin">
                `;
            };

            reader.readAsDataURL(arquivo);

        });

    }

});