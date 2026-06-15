const conteudos = JSON.parse(
    document.getElementById("dadosConteudos").value
);

const menu = document.getElementById("menuConteudos");
const area = document.getElementById("conteudoUsuario");
const contador = document.getElementById("contadorConteudos");

contador.innerText = conteudos.length;

if (conteudos.length === 0) {

    menu.innerHTML = `
        <p class="vazio">
            Nenhum conteúdo cadastrado.
        </p>
    `;

    area.innerHTML = `
        <p class="vazio">
            Ainda não há conteúdos disponíveis.
        </p>
    `;

} else {

    conteudos.forEach((item, index) => {

        menu.innerHTML += `
            <div
                class="tab-conteudo ${index === 0 ? "active" : ""}"
                onclick="abrirConteudo(${index})"
            >
                <div class="tab-icon">
                    ${definirIcone(item)}
                </div>

                <div class="tab-textos">
                    <h4>${item.tituloConteudo}</h4>
                    <p>${item.textoConteudo}</p>
                </div>
            </div>
        `;

    });

    abrirConteudo(0);
}

function abrirConteudo(index) {

    const item = conteudos[index];

    document.querySelectorAll(".tab-conteudo")
        .forEach(tab => tab.classList.remove("active"));

    document.querySelectorAll(".tab-conteudo")[index]
        .classList.add("active");

    area.innerHTML = `
        <h3>${item.tituloConteudo}</h3>

        <p class="texto-conteudo texto-limitado" id="textoAberto">
            ${item.textoConteudo}
        </p>

        <button class="btn-vermais" onclick="alternarConteudo()">
            Ver mais
        </button>

        <div id="conteudoExtra" style="display:none;">

            ${
                item.imagemConteudo
                ? `<img src="../assets/img/${item.imagemConteudo}" class="imagem-conteudo">`
                : ""
            }

            ${
                item.videoConteudo
                ? `<iframe src="${transformarVideo(item.videoConteudo)}" allowfullscreen></iframe>`
                : ""
            }

            ${
                item.linkConteudo
                ? `<a href="${item.linkConteudo}" target="_blank" class="btn-conteudo">Acessar conteúdo</a>`
                : ""
            }

        </div>
    `;
}

function alternarConteudo() {

    const conteudo = document.getElementById("conteudoExtra");
    const botao = document.querySelector(".btn-vermais");
    const texto = document.getElementById("textoAberto");

    if (conteudo.style.display === "none") {

        conteudo.style.display = "block";
        texto.classList.remove("texto-limitado");
        botao.innerText = "Ver menos";

    } else {

        conteudo.style.display = "none";
        texto.classList.add("texto-limitado");
        botao.innerText = "Ver mais";

    }
}

function transformarVideo(url) {

    if (!url) return "";

    if (url.includes("watch?v=")) {
        return url.replace("watch?v=", "embed/");
    }

    if (url.includes("youtu.be/")) {
        return url.replace(
            "youtu.be/",
            "www.youtube.com/embed/"
        );
    }

    return url;
}

function definirIcone(item) {

    if (item.videoConteudo) return "▶";
    if (item.imagemConteudo) return "🖼";
    if (item.linkConteudo) return "🔗";

    return "📄";
}