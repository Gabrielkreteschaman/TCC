<?php
    require_once '../model/Usuario.php';

    $erros = [];

    //Verefica se o formulário foi enviado
    if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nome = trim($_POST["nomeUsuario"] ?? "");
            $email = trim($_POST["emailUsuario"] ?? "");
            $senha = trim($_POST["senhaUsuario"] ?? "");
            $confirmaSenha = trim($_POST["confirmaSenha"] ?? "");
        

        //Vaidar nome
        if($nome == ""){
            $erros[] = "O nome é obrigatório!";
        } elseif(strlen($nome) < 3){
            $erros[] = "O nome deve ter pelo menos 3 letras!";
        }

        //Vaidar email
        if($email == ""){
            $erros[] = "O e-mail é obrigatório!";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $erros[] = "Digite um e-mail válido!";
        }
        $usuario = new Usuario();

        if($usuario->emailExiste($email)){
            $erros[] = "Este e-mail já está cadastrado.";
        }

        // Validar senha
        if ($senha == "") {
            $erros[] = "A senha é obrigatória.";
        } elseif (strlen($senha) < 6) {
            $erros[] = "A senha deve ter no mínimo 6 caracteres.";
        } elseif (!preg_match("/[A-Z]/", $senha)) {
            $erros[] = "A senha precisa ter uma letra maiúscula.";
        } elseif (!preg_match("/[0-9]/", $senha)) {
            $erros[] = "A senha precisa ter um número.";
        } elseif (!preg_match("/[\W]/", $senha)) {
            $erros[] = "A senha precisa ter um caractere especial.";
        }

        // Confirmar senha
        if ($confirmaSenha == "") {
            $erros[] = "Confirme sua senha.";
        } elseif ($senha != $confirmaSenha) {
            $erros[] = "As senhas não são iguais.";
        }

        // Validar foto
        if (!isset($_FILES["fotoUsuario"]) || $_FILES["fotoUsuario"]["error"] != 0) {
            $erros[] = "A foto é obrigatória.";
        } else {

            $foto = $_FILES["fotoUsuario"];

            $tiposPermitidos = ["image/jpeg", "image/png", "image/jpg"];
            $tamanhoMaximo = 5 * 1024 * 1024;

            if (!in_array($foto["type"], $tiposPermitidos)) {
                $erros[] = "A foto deve ser JPG ou PNG.";
            }

            if ($foto["size"] > $tamanhoMaximo) {
                $erros[] = "A foto deve ter no máximo 5 MB.";
            }

            // Salvar imagem
            $pasta = "../assets/img/";
            $nomeFoto = $foto["name"];
            $caminhoFoto = $pasta . $nomeFoto;

            move_uploaded_file($foto["tmp_name"], $caminhoFoto);
        }

        // Se tiver erro, mostra os erros
        if (count($erros) > 0) {

            session_start();

            $_SESSION["errosCadastro"] = $erros;

            header("Location: ../view/formUsuario.php");
            exit;
        }

        // Salvar imagem depois que não tiver erro
        move_uploaded_file($foto["tmp_name"], $caminhoFoto);

        // Cadastrar no banco
        $usuario = new Usuario();

        $cadastrou = $usuario->cadastrar(
            $nomeFoto,
            $nome,
            $email,
            $senha
        );

        if ($cadastrou) {
            header("Location: ../view/cadastroSucesso.php?nome=$nome&email=$email&foto=$nomeFoto");
            exit;
        } else {
            echo "Erro ao cadastrar usuário.";
        }

    }
    
?>