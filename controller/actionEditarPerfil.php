<?php
session_start();

unset($_SESSION["errosPerfil"]);

require_once "../model/BD.php";

$bd = new BD();
$conexao = $bd->conectar();

$errosPerfil = [];

$idUsuario = $_SESSION["idUsuario"];
$emailUsuario = $_POST["emailUsuario"];

$sqlEmail = "SELECT idUsuario
             FROM usuario
             WHERE emailUsuario = ?
             AND idUsuario != ?";

$stmtEmail = $conexao->prepare($sqlEmail);
$stmtEmail->bind_param("si", $emailUsuario, $idUsuario);
$stmtEmail->execute();

$resultEmail = $stmtEmail->get_result();
if ($resultEmail->num_rows > 0) {
    $errosPerfil[] = "Este e-mail já está cadastrado.";
}

if(!isset($_SESSION["idUsuario"])){
    header("Location: ../view/formLogin.php");
    exit;
}

$id = $_SESSION["idUsuario"];
$nome = trim($_POST["nomeUsuario"] ?? "");
$email = trim($_POST["emailUsuario"] ?? "");
$novaSenha = trim($_POST["novaSenha"] ?? "");
$confirmaSenha = trim($_POST["confirmaSenha"] ?? "");

if(!empty($novaSenha)){

    if($novaSenha !== $confirmaSenha){

        $errosPerfil[] = "As senhas não coincidem.";
    }

    $senhaCriptografada = password_hash(
        $novaSenha,
        PASSWORD_DEFAULT
    );
}

$foto = $_SESSION["fotoUsuario"];

if(isset($_FILES["fotoUsuario"]) && $_FILES["fotoUsuario"]["error"] == 0){

    $fotoArquivo = $_FILES["fotoUsuario"];

    $tiposPermitidos = [
        "image/jpeg",
        "image/png",
        "image/jpg"
    ];

    $tamanhoMaximo = 5 * 1024 * 1024;

    if(!in_array($fotoArquivo["type"], $tiposPermitidos)){
        $errosPerfil[] =
            "A foto deve ser JPG ou PNG.";
    }

    if($fotoArquivo["size"] > $tamanhoMaximo){
        $errosPerfil[] =
            "A foto deve ter no máximo 5 MB.";
    }

    if(!empty($_SESSION["errosPerfil"])){
        header("Location: ../view/index.php");
        exit;
    }

    $nomeFoto = $fotoArquivo["name"];
    $caminho = "../assets/img/" . $nomeFoto;

    move_uploaded_file(
        $fotoArquivo["tmp_name"],
        $caminho
    );

    $foto = $nomeFoto;
}

if (!empty($errosPerfil)) {
    $_SESSION["errosPerfil"] = $errosPerfil;
    header("Location: ../view/index.php");
    exit;
}

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