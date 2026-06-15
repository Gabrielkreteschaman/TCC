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

$id = $_GET["id"] ?? 0;

$conteudoModel = new Conteudo();
$item = $conteudoModel->buscarPorId($id);

if (!$item) {
    header("Location: editarConteudos.php");
    exit;
}

include "header.php";
?>
<script src="../assets/JS/adminConteudos.js"></script>
<section class="contact">
    <h2 class="section-title">Editar Conteúdo</h2>

    <div class="contact-form">

        <form action="../controller/actionEditarConteudo.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="idConteudo" value="<?= $item["idConteudo"] ?>">
            <input type="hidden" name="imagemAtual" value="<?= $item["imagemConteudo"] ?>">

            <div class="form-group">
                <label>Título</label>
                <input type="text" name="tituloConteudo" value="<?= $item["tituloConteudo"] ?>">
            </div>

            <div class="form-group">
                <label>Conteúdo</label>
                <textarea name="textoConteudo" rows="8"><?= $item["textoConteudo"] ?></textarea>
            </div>

            <?php if (!empty($item["imagemConteudo"])): ?>
                <div class="form-group">
                    <label>Imagem atual</label>
                    <img src="../assets/img/<?= $item["imagemConteudo"] ?>" style="width:100%; border-radius:10px;">
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="imagemConteudo">Nova imagem</label>
                <input type="file" id="imagemConteudo" name="imagemConteudo" accept=".jpg,.jpeg,.png,.webp" hidden>
                <label for="imagemConteudo" class="upload-conteudo" id="btnImagemConteudo">
                    <i class="bi bi-image-fill"></i>
                    <span>Selecionar imagem</span>
                    <small>JPG, PNG ou WEBP</small>
                </label>
                <div id="previewConteudo"></div>
            </div>

            <div class="form-group">
                <label>Vídeo</label>
                <input type="text" name="videoConteudo" placeholder="https://youtube.com/..." value="<?= $item["videoConteudo"] ?>">
            </div>

            <div class="form-group">
                <label>Link</label>
                <input type="text" name="linkConteudo" placeholder="https://..." value="<?= $item["linkConteudo"] ?>">
            </div>

            <button type="submit" class="submit-btn">Salvar Alterações</button>

        </form>

    </div>
</section>

<?php include "footer.php"; ?>