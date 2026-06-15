<?php
    require_once "../model/BD.php";

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ../view/formLogin.php");
        exit;
    }

    $email = trim($_POST["emailUsuario"] ?? "");
    $senha = trim($_POST["senhaUsuario"] ?? "");

    if ($email == "" || $senha == "") {
        session_start();

        $_SESSION["errosLogin"] = [
            "Preencha e-mail e senha."
        ];

        header("Location: ../view/formLogin.php");
        exit;
    }

    $bd = new BD();
    $conexao = $bd->conectar();

    $sql = "SELECT * FROM usuario WHERE emailUsuario = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {
        session_start();

        $_SESSION["errosLogin"] = [
            "E-mail ou senha inválidos."
        ];

        header("Location: ../view/formLogin.php");
        exit;
    }

    $usuario = $resultado->fetch_assoc();

    if (password_verify($senha, $usuario["senhaUsuario"]) || $senha == $usuario["senhaUsuario"]) {

        session_start();

        $_SESSION["fotoUsuario"] = $usuario["fotoUsuario"];
        $_SESSION["idUsuario"] = $usuario["idUsuario"];
        $_SESSION["nomeUsuario"] = $usuario["nomeUsuario"];
        $_SESSION["emailUsuario"] = $usuario["emailUsuario"];
        $_SESSION["tipoUsuario"] = $usuario["tipoUsuario"];

        if ($usuario["tipoUsuario"] == "admin") {
            header("Location: ../view/formEditarConteudo.php");
            exit;
        } else {
            header("Location: ../view/index.php");
            exit;
        }

    } else {
        session_start();

        $_SESSION["errosLogin"] = [
            "E-mail ou senha inválidos."
        ];

        header("Location: ../view/formLogin.php");
        exit;
    }
?>