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

$id = $_GET["id"] ?? 0;

if (!$id) {
    header("Location: ../view/editarConteudos.php");
    exit;
}

$conteudo = new Conteudo();

$conteudo->excluir($id);

$_SESSION["sucessoConteudo"] =
    "Conteúdo excluído com sucesso.";

header("Location: ../view/editarConteudos.php");
exit;