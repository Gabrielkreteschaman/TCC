<?php
session_start();

if (
    !isset($_SESSION["idUsuario"]) ||
    $_SESSION["tipoUsuario"] !== "admin"
) {
    header("Location: ../view/index.php");
    exit;
}

require_once "../model/Conteudo.php";

$erros = [];

$id = $_POST["idConteudo"] ?? 0;
$titulo = trim($_POST["tituloConteudo"] ?? "");
$texto = trim($_POST["textoConteudo"] ?? "");
$video = trim($_POST["videoConteudo"] ?? "");
$link = trim($_POST["linkConteudo"] ?? "");
$imagem = $_POST["imagemAtual"] ?? "";

if (empty($titulo)) {
    $erros[] = "Informe o título.";
}

if (empty($texto)) {
    $erros[] = "Informe o conteúdo.";
}

if (isset($_FILES["imagemConteudo"]) && $_FILES["imagemConteudo"]["error"] == 0) {

    $arquivo = $_FILES["imagemConteudo"];

    $tiposPermitidos = [
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/webp"
    ];

    if (!in_array($arquivo["type"], $tiposPermitidos)) {
        $erros[] = "A imagem deve ser JPG, PNG ou WEBP.";
    }

    if ($arquivo["size"] > 5 * 1024 * 1024) {
        $erros[] = "A imagem deve ter no máximo 5 MB.";
    }

    if (empty($erros)) {
        $imagem = time() . "_" . basename($arquivo["name"]);

        move_uploaded_file(
            $arquivo["tmp_name"],
            "../assets/img/" . $imagem
        );
    }
}

if (!empty($erros)) {
    $_SESSION["errosConteudo"] = $erros;
    header("Location: ../view/formEditarConteudo.php?id=" . $id);
    exit;
}

$conteudo = new Conteudo();

$conteudo->atualizar(
    $id,
    $titulo,
    $texto,
    $imagem,
    $video,
    $link,
);

$_SESSION["sucessoConteudo"] = "Conteúdo atualizado com sucesso.";

header("Location: ../view/editarConteudos.php");
exit;