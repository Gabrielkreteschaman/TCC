<?php include "header.php" ?>

<section class="features">
    <h2 class="section-title">CONTEÚDOS DISPONÍVEIS</h2>

    <div class="conteudos-container">

        <div class="menu-conteudos">
            <div class="menu-topo">
                <h3>Lista</h3>
                <span id="contadorConteudos">0</span>
            </div>

            <div id="menuConteudos"></div>
        </div>

        <div class="visualizacao-conteudo" id="conteudoUsuario"></div>

    </div>
</section>

<style>
.conteudos-container {
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 310px 1fr;
    gap: 32px;
    align-items: start;
}

.menu-conteudos {
    height: 455px;
    overflow-y: auto;
    background:
        radial-gradient(circle at top left, rgba(0, 178, 255, 0.12), transparent 35%),
        linear-gradient(180deg, rgba(0, 28, 35, 0.96), rgba(0, 10, 14, 0.96));
    border: 1px solid rgba(0, 178, 255, 0.45);
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 0 25px rgba(0, 178, 255, 0.12);
}

.menu-topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

.menu-topo h3 {
    color: #ff8c42;
}

#contadorConteudos {
    background: rgba(255, 94, 0, 0.15);
    color: #ff8c42;
    border: 1px solid rgba(255, 94, 0, 0.45);
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
}

.tab-conteudo {
    display: grid;
    grid-template-columns: 42px 1fr;
    gap: 12px;
    padding: 14px;
    margin-bottom: 14px;
    border-radius: 14px;
    color: #fff;
    cursor: pointer;
    transition: 0.25s ease;
    background: rgba(255, 255, 255, 0.025);
    border: 1px solid transparent;
}

.tab-conteudo:hover {
    transform: translateX(5px);
    border-color: rgba(255, 94, 0, 0.8);
    background: rgba(255, 94, 0, 0.10);
}

.tab-conteudo.active {
    border: 1px solid #ff5e00;
    background: linear-gradient(135deg, rgba(255, 94, 0, 0.25), rgba(0, 178, 255, 0.08));
}

.tab-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(255, 94, 0, 0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff8c42;
    font-size: 20px;
}

.tab-textos h4 {
    color: #fff;
    font-size: 15px;
    margin-bottom: 5px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tab-textos p {
    color: #aaa;
    font-size: 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
}

.visualizacao-conteudo {
    height: 455px;
    overflow-y: auto;
    position: relative;
    background:
        radial-gradient(circle at top right, rgba(255, 94, 0, 0.18), transparent 35%),
        linear-gradient(135deg, rgba(20, 9, 3, 0.98), rgba(7, 7, 7, 0.98));
    border: 1px solid rgba(255, 94, 0, 0.55);
    border-radius: 18px;
    padding: 38px;
    box-shadow: 0 0 28px rgba(255, 94, 0, 0.13);
    animation: aparecer 0.35s ease;
}

@keyframes aparecer {
    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.visualizacao-conteudo img {
    width: 100%;
    max-height: 225px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 24px;
    border: 1px solid rgba(0, 178, 255, 0.35);
}

.visualizacao-conteudo iframe {
    width: 100%;
    height: 255px;
    border: none;
    border-radius: 14px;
    margin-bottom: 24px;
}

.visualizacao-conteudo .tag {
    display: inline-block;
    margin-bottom: 14px;
    padding: 6px 12px;
    border-radius: 20px;
    background: rgba(255, 94, 0, 0.15);
    color: #ff8c42;
    border: 1px solid rgba(255, 94, 0, 0.35);
    font-size: 12px;
    text-transform: uppercase;
}

.visualizacao-conteudo h3 {
    color: #ffb48a;
    font-size: 32px;
    margin-bottom: 18px;
    letter-spacing: 0.5px;
    word-break: break-word;
}

.texto-conteudo {
    color: #d7d7d7;
    line-height: 1.8;
    font-size: 15.5px;
    margin-bottom: 20px;
    word-break: break-word;
    overflow-wrap: break-word;
}

.texto-limitado {
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.btn-vermais,
.visualizacao-conteudo a {
    display: inline-block;
    padding: 12px 22px;
    background: linear-gradient(135deg, #ff5e00, #ff8c42);
    color: white;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    border: none;
    cursor: pointer;
    margin-right: 10px;
    margin-top: 6px;
}

.btn-vermais:hover,
.visualizacao-conteudo a:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 20px rgba(255, 94, 0, 0.35);
}

.vazio {
    color: #ccc;
    font-size: 16px;
    line-height: 1.6;
}

.menu-conteudos::-webkit-scrollbar,
.visualizacao-conteudo::-webkit-scrollbar {
    width: 8px;
}

.menu-conteudos::-webkit-scrollbar-thumb,
.visualizacao-conteudo::-webkit-scrollbar-thumb {
    background: #ff5e00;
    border-radius: 10px;
}

@media(max-width: 850px) {
    .conteudos-container {
        grid-template-columns: 1fr;
    }

    .menu-conteudos,
    .visualizacao-conteudo {
        height: auto;
        max-height: 520px;
    }
}
</style>

<script>
const conteudos = JSON.parse(localStorage.getItem("conteudos")) || [];

const menu = document.getElementById("menuConteudos");
const area = document.getElementById("conteudoUsuario");
const contador = document.getElementById("contadorConteudos");

contador.innerText = conteudos.length;

if (conteudos.length === 0) {
    menu.innerHTML = `<p class="vazio">Nenhum conteúdo cadastrado.</p>`;
    area.innerHTML = `<p class="vazio">Ainda não há conteúdos disponíveis.</p>`;
} else {
    conteudos.forEach((item, index) => {
        menu.innerHTML += `
            <div class="tab-conteudo ${index === 0 ? "active" : ""}" onclick="abrirConteudo(${index})">
                <div class="tab-icon">${definirIcone(item)}</div>

                <div class="tab-textos">
                    <h4>${item.titulo}</h4>
                    <p>${item.texto}</p>
                </div>
            </div>
        `;
    });

    abrirConteudo(0);
}

function abrirConteudo(index) {
    const item = conteudos[index];
    const video = transformarVideo(item.video);

    document.querySelectorAll(".tab-conteudo").forEach(tab => {
        tab.classList.remove("active");
    });

    document.querySelectorAll(".tab-conteudo")[index].classList.add("active");

    area.style.animation = "none";
    area.offsetHeight;
    area.style.animation = "aparecer 0.35s ease";

    area.innerHTML = `
        ${item.imagem ? `<img src="${item.imagem}" alt="${item.titulo}">` : ""}

        <span class="tag">Conteúdo</span>

        <h3>${item.titulo}</h3>

        <p class="texto-conteudo texto-limitado" id="textoAberto">${item.texto}</p>

        ${item.texto.length > 350 ? `
            <button class="btn-vermais" onclick="alternarTexto()">Ver mais</button>
        ` : ""}

        ${video ? `<iframe src="${video}" allowfullscreen></iframe>` : ""}

        ${item.link ? `<a href="${item.link}" target="_blank">Acessar conteúdo</a>` : ""}
    `;
}

function alternarTexto() {
    const texto = document.getElementById("textoAberto");
    const botao = document.querySelector(".btn-vermais");

    texto.classList.toggle("texto-limitado");

    if (texto.classList.contains("texto-limitado")) {
        botao.innerText = "Ver mais";
    } else {
        botao.innerText = "Ver menos";
    }
}

function transformarVideo(url) {
    if (!url) return "";

    if (url.includes("watch?v=")) {
        return url.replace("watch?v=", "embed/");
    }

    if (url.includes("youtu.be/")) {
        return url.replace("youtu.be/", "www.youtube.com/embed/");
    }

    return url;
}

function definirIcone(item) {
    if (item.video) return "▶";
    if (item.imagem) return "🖼";
    if (item.link) return "🔗";
    return "⚡";
}
</script>

<?php include "footer.php" ?>