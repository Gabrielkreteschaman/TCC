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

$titulo = trim($_POST["tituloConteudo"] ?? "");
$texto = trim($_POST["textoConteudo"] ?? "");
$video = trim($_POST["videoConteudo"] ?? "");
$link = trim($_POST["linkConteudo"] ?? "");

if (empty($titulo)) {
    $erros[] = "Informe o título.";
}

if (empty($texto)) {
    $erros[] = "Informe o conteúdo.";
}

$imagem = "";

if (
    isset($_FILES["imagemConteudo"]) &&
    $_FILES["imagemConteudo"]["error"] == 0
) {

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

    header("Location: ../view/editarConteudos.php");
    exit;
}

$conteudo = new Conteudo();

$conteudo->cadastrar(
    $titulo,
    $texto,
    $imagem,
    $video,
    $link,
    "publicado",
    $_SESSION["idUsuario"]
);

$_SESSION["sucessoConteudo"] =
    "Conteúdo cadastrado com sucesso.";

header("Location: ../view/editarConteudos.php");
exit;