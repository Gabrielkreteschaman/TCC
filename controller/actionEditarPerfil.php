<?php
session_start();

require_once "../model/BD.php";

if(!isset($_SESSION["idUsuario"])){
    header("Location: ../view/formLogin.php");
    exit;
}

$id = $_SESSION["idUsuario"];
$nome = trim($_POST["nomeUsuario"] ?? "");
$email = trim($_POST["emailUsuario"] ?? "");
$novaSenha = trim($_POST["novaSenha"] ?? "");
$confirmaSenha = trim($_POST["confirmaSenha"] ?? "");

if($novaSenha !== $confirmaSenha){
    die("As senhas não são iguais.");
}

$senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

$foto = $_SESSION["fotoUsuario"];

if(isset($_FILES["fotoUsuario"]) && $_FILES["fotoUsuario"]["error"] == 0){

    $nomeFoto = $_FILES["fotoUsuario"]["name"];
    $caminho = "../assets/img/" . $nomeFoto;

    move_uploaded_file($_FILES["fotoUsuario"]["tmp_name"], $caminho);

    $foto = $nomeFoto;
}

$bd = new BD();
$conexao = $bd->conectar();

$sql = "UPDATE usuario 
        SET nomeUsuario = ?, 
            emailUsuario = ?, 
            fotoUsuario = ?,
            senhaUsuario = ?
        WHERE idUsuario = ?";

$stmt = $conexao->prepare($sql);

$stmt->bind_param(
    "ssssi",
    $nome,
    $email,
    $foto,
    $senhaCriptografada,
    $id
);

if($stmt->execute()){

    $_SESSION["nomeUsuario"] = $nome;
    $_SESSION["emailUsuario"] = $email;
    $_SESSION["fotoUsuario"] = $foto;

    header("Location: ../view/index.php");
    exit;

}else{
    echo "Erro ao atualizar perfil.";
}
?>