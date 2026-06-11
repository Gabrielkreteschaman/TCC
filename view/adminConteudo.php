<?php include "header.php" ?>

<section class="features">
    <h2 class="section-title">GERENCIAMENTO DE CONTEÚDO</h2>

    <div class="admin-container">

        <div class="admin-form">
            <h3 id="tituloForm">Adicionar conteúdo</h3>

            <input type="text" id="titulo" placeholder="Título do conteúdo">
            <textarea id="texto" placeholder="Texto do conteúdo"></textarea>
            <input type="url" id="link" placeholder="Link externo">
            <input type="url" id="video" placeholder="Link do vídeo do YouTube">
            <input type="file" id="imagem" accept="image/*">

            <button onclick="salvarConteudo()" id="btnSalvar">
                Adicionar conteúdo +
            </button>
        </div>

        <div class="admin-lista">

            <div class="admin-topo">
                <h3>Conteúdos cadastrados</h3>
                <span id="contadorAdmin">0</span>
            </div>

            <input 
                type="text" 
                id="pesquisaAdmin" 
                class="pesquisa-admin" 
                placeholder="Pesquisar conteúdo..."
                oninput="mostrarAdmin()"
            >

            <div id="listaAdmin"></div>

        </div>

    </div>
</section>

<style>
.admin-lista::-webkit-scrollbar {
    width: 8px;
}

.admin-lista::-webkit-scrollbar-track {
    background: rgba(255,255,255,0.03);
    border-radius: 20px;
}

.admin-lista::-webkit-scrollbar-thumb {
    background: linear-gradient(
        180deg,
        #ff5e00,
        #ff8c42
    );
    border-radius: 20px;
}

.admin-lista::-webkit-scrollbar-thumb:hover {
    background: #ff5e00;
}
/* Pesquisa*/
.pesquisa-admin {
    width: 100%;
    margin-bottom: 18px;
    padding: 13px;
    background: #111;
    color: #fff;
    border: 1px solid rgba(0, 178, 255, 0.45);
    border-radius: 10px;
    outline: none;
}

.pesquisa-admin:focus {
    border-color: #ff5e00;
    box-shadow: 0 0 12px rgba(255, 94, 0, 0.25);
}
/* fim */

.admin-container {
    max-width: 1180px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 310px 1fr;
    gap: 28px;
    align-items: start;
}

.admin-form,
.admin-lista {
    background:
        radial-gradient(circle at top right, rgba(255, 94, 0, 0.12), transparent 35%),
        rgba(10, 10, 10, 0.96);
    border: 1px solid rgba(255, 94, 0, 0.55);
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 0 26px rgba(255, 94, 0, 0.12);
}

.admin-form h3,
.admin-lista h3 {
    color: #ff8c42;
    margin-bottom: 20px;
}

.admin-form input,
.admin-form textarea {
    width: 100%;
    margin-bottom: 14px;
    padding: 13px;
    background: #111;
    color: #fff;
    border: 1px solid #333;
    border-radius: 10px;
    outline: none;
    transition: 0.25s;
}

.admin-form textarea {
    height: 125px;
    resize: none;
}

.admin-form input:focus,
.admin-form textarea:focus {
    border-color: #ff5e00;
    box-shadow: 0 0 12px rgba(255, 94, 0, 0.25);
}

.admin-form button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #ff5e00, #ff8c42);
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.25s;
}

.admin-form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 22px rgba(255, 94, 0, 0.38);
}

.admin-lista {
    max-height: 540px;
    overflow-y: auto;
}

.admin-topo {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

#contadorAdmin {
    background: rgba(0, 178, 255, 0.15);
    color: #00b2ff;
    border: 1px solid rgba(0, 178, 255, 0.4);
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
}

.item-admin {
    display: grid;
    grid-template-columns: 90px 1fr;
    gap: 16px;
    border: 1px solid rgba(0, 178, 255, 0.45);
    background: linear-gradient(135deg, rgba(0, 178, 255, 0.07), rgba(255, 94, 0, 0.04));
    padding: 16px;
    border-radius: 14px;
    margin-bottom: 16px;
    transition: 0.25s;
}

.item-admin:hover {
    transform: translateY(-3px);
    border-color: #ff5e00;
}

.item-admin img {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid rgba(255, 94, 0, 0.4);
}

.sem-img {
    width: 90px;
    height: 90px;
    border-radius: 10px;
    background: rgba(255, 94, 0, 0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff8c42;
    font-size: 24px;
}

.item-admin h4 {
    color: #ff8c42;
    margin-bottom: 7px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.item-admin p {
    color: #d0d0d0;
    line-height: 1.5;
    font-size: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    word-break: break-word;
}

.acoes {
    display: flex;
    gap: 10px;
    margin-top: 12px;
}

.acoes button {
    padding: 8px 14px;
    border: none;
    border-radius: 8px;
    color: white;
    cursor: pointer;
}

.editar {
    background: #00b2ff;
}

.excluir {
    background: #d93636;
}

.vazio {
    color: #ccc;
}

@media(max-width: 850px) {
    .admin-container {
        grid-template-columns: 1fr;
    }

    .item-admin {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
let conteudos = JSON.parse(localStorage.getItem("conteudos")) || [];
let editando = null;

mostrarAdmin();

function salvarConteudo() {
    const titulo = document.getElementById("titulo").value.trim();
    const texto = document.getElementById("texto").value.trim();
    const link = document.getElementById("link").value.trim();
    const video = document.getElementById("video").value.trim();
    const imagem = document.getElementById("imagem").files[0];

    if (!titulo || !texto) {
        alert("Preencha título e texto.");
        return;
    }

    if (imagem) {
        const reader = new FileReader();

        reader.onload = function(e) {
            gravarConteudo(titulo, texto, link, video, e.target.result);
        };

        reader.readAsDataURL(imagem);
    } else {
        gravarConteudo(titulo, texto, link, video, "");
    }
}

function gravarConteudo(titulo, texto, link, video, imagem) {
    const dados = {
        titulo,
        texto,
        link,
        video,
        imagem
    };

    if (editando === null) {
        conteudos.push(dados);
    } else {
        if (!imagem) {
            dados.imagem = conteudos[editando].imagem;
        }

        conteudos[editando] = dados;
        editando = null;

        document.getElementById("btnSalvar").innerText = "Adicionar conteúdo +";
        document.getElementById("tituloForm").innerText = "Adicionar conteúdo";
    }

    localStorage.setItem("conteudos", JSON.stringify(conteudos));

    limparCampos();
    mostrarAdmin();
}

function mostrarAdmin() {
    const lista = document.getElementById("listaAdmin");
    const contador = document.getElementById("contadorAdmin");
    const pesquisa = document.getElementById("pesquisaAdmin")?.value.toLowerCase() || "";

    const filtrados = conteudos.filter(item =>
        item.titulo.toLowerCase().includes(pesquisa) ||
        item.texto.toLowerCase().includes(pesquisa)
    );

    contador.innerText = filtrados.length;
    lista.innerHTML = "";

    if (conteudos.length === 0) {
        lista.innerHTML = `<p class="vazio">Nenhum conteúdo cadastrado.</p>`;
        return;
    }

    if (filtrados.length === 0) {
        lista.innerHTML = `<p class="vazio">Nenhum conteúdo encontrado.</p>`;
        return;
    }

    filtrados.forEach((item) => {
        const index = conteudos.indexOf(item);

        lista.innerHTML += `
            <div class="item-admin">
                ${item.imagem ? `<img src="${item.imagem}">` : `<div class="sem-img">⚡</div>`}

                <div>
                    <h4>${item.titulo}</h4>
                    <p>${item.texto}</p>

                    <div class="acoes">
                        <button class="editar" onclick="editarConteudo(${index})">Editar</button>
                        <button class="excluir" onclick="excluirConteudo(${index})">Excluir</button>
                    </div>
                </div>
            </div>
        `;
    });
}

function editarConteudo(index) {
    const item = conteudos[index];

    document.getElementById("titulo").value = item.titulo;
    document.getElementById("texto").value = item.texto;
    document.getElementById("link").value = item.link;
    document.getElementById("video").value = item.video;

    editando = index;

    document.getElementById("btnSalvar").innerText = "Salvar edição";
    document.getElementById("tituloForm").innerText = "Editando conteúdo";
}

function excluirConteudo(index) {
    conteudos.splice(index, 1);
    localStorage.setItem("conteudos", JSON.stringify(conteudos));
    mostrarAdmin();
}

function limparCampos() {
    document.getElementById("titulo").value = "";
    document.getElementById("texto").value = "";
    document.getElementById("link").value = "";
    document.getElementById("video").value = "";
    document.getElementById("imagem").value = "";
}
</script>

<?php include "footer.php" ?>