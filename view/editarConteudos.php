<?php
session_start();

if (
    !isset($_SESSION["idUsuario"]) ||
    $_SESSION["tipoUsuario"] !== "admin"
) {
    header("Location: index.php");
    exit;
}

require_once "../model/Conteudo.php";

$conteudoModel = new Conteudo();
$conteudos = $conteudoModel->listarTodos();

include "header.php";
?>
<script src="../assets/JS/adminConteudos.js"></script>

<section class="contact">

    <h2 class="section-title">
        Gerenciamento de Conteúdo
    </h2>
    <div class="admin-conteudo-grid">

        <div class="contact-form" id="formConteudo">
            <form action="../controller/actionConteudo.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="tituloConteudo">Título</label>
                    <input type="text" id="tituloConteudo" name="tituloConteudo" placeholder="Digite o título" required>
                </div>

                <div class="form-group">
                    <label for="textoConteudo">Texto</label>
                    <textarea id="textoConteudo" name="textoConteudo" rows="8" placeholder="Digite o conteúdo" required></textarea>
                </div>

                <div class="form-group">
                    <label for="imagemConteudo">Imagem</label>
                    <input type="file" id="imagemConteudo" name="imagemConteudo" accept=".jpg,.jpeg,.png,.webp" hidden>
                    <label for="imagemConteudo" class="upload-conteudo" id="btnImagemConteudo">
                        <i class="bi bi-image-fill"></i>
                        <span>Selecionar imagem</span>
                        <small>JPG, PNG ou WEBP</small>
                    </label>
                    <div id="previewConteudo"></div>
                </div>

                <div class="form-group">
                    <label for="videoConteudo">Vídeo</label>
                    <input type="text" id="videoConteudo" name="videoConteudo" placeholder="https://youtube.com/...">
                </div>

                <div class="form-group">
                    <label for="linkConteudo">Link</label>
                    <input type="text" id="linkConteudo" name="linkConteudo" placeholder="https://...">
                </div>

                <button type="submit" class="submit-btn">
                    Salvar Conteúdo
                </button>

            </form>
        </div>

        <div class="contact-form lista-conteudos-box" id="listaConteudos">

            <h3>Conteúdos cadastrados</h3>

            <div class="tabela-scroll">
                <div class="barra-pesquisa-admin">
                    <i class="bi bi-search"></i>

                    <input
                        type="text"
                        id="pesquisarConteudoAdmin"
                        placeholder="Pesquisar conteúdo..."
                    >
                </div>

                <div
                    id="nenhumResultado"
                    class="nenhum-resultado"
                    style="display:none;"
                >
                    Nenhum conteúdo encontrado.
                </div>
                <table class="table table-dark table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody id="listaConteudosAdmin">
                        <?php while($item = $conteudos->fetch_assoc()): ?>
                            <tr>
                                <td><?= $item["idConteudo"] ?></td>

                                <td>
                                    <?php if(!empty($item["imagemConteudo"])): ?>
                                        <img 
                                            src="../assets/img/<?= $item["imagemConteudo"] ?>" 
                                            class="miniatura-admin"
                                        >
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>

                                <td class="titulo-conteudo-admin">
                                    <?= htmlspecialchars($item["tituloConteudo"]) ?>
                                </td>

                                <td>
                                    <a href="formEditarConteudo.php?id=<?= $item["idConteudo"] ?>" class="btn btn-primary btn-sm">
                                        Editar
                                    </a>

                                    <a href="../controller/excluirConteudo.php?id=<?= $item["idConteudo"] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Deseja excluir este conteúdo?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</section>

<?php include "footer.php"; ?>