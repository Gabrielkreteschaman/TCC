<?php
    require_once 'BD.php';

    class Usuario {

        public function emailExiste($email){
            $bd = new BD();
            $conexao = $bd->conectar();

            $sql = "SELECT idUsuario FROM usuario WHERE emailUsuario = ?";

            $stmt = $conexao->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $resultado = $stmt->get_result();

            return $resultado->num_rows > 0;
        }

        public function cadastrar($foto, $nome, $email, $senha) {
            $bd = new BD();
            $conexao = $bd->conectar();

            $tipoUsuario = "usuario";
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuario 
                    (fotoUsuario, nomeUsuario, emailUsuario, senhaUsuario, tipoUsuario)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexao->prepare($sql);
            $stmt->bind_param(
                "sssss",
                $foto,
                $nome,
                $email,
                $senhaCriptografada,
                $tipoUsuario
            );

            return $stmt->execute();
        }
    }
?>