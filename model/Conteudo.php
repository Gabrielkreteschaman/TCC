<?php

require_once "BD.php";

class Conteudo {

    private $conexao;

    public function __construct() {
        $bd = new BD();
        $this->conexao = $bd->conectar();
    }

    public function cadastrar(
        $titulo,
        $texto,
        $imagem,
        $video,
        $link,
        $idUsuario
    ){
        $sql = "INSERT INTO conteudo (
                    tituloConteudo,
                    textoConteudo,
                    imagemConteudo,
                    videoConteudo,
                    linkConteudo,
                    idUsuario
                )
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bind_param(
            "ssssssi",
            $titulo,
            $texto,
            $imagem,
            $video,
            $link,
            $idUsuario
        );

        return $stmt->execute();
    }

    public function listarTodos() {
        $sql = "SELECT * FROM conteudo ORDER BY idConteudo DESC";
        return $this->conexao->query($sql);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM conteudo WHERE idConteudo = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function atualizar($id, $titulo, $texto, $imagem, $video, $link) {

        $sql = "UPDATE conteudo
                SET tituloConteudo = ?,
                    textoConteudo = ?,
                    imagemConteudo = ?,
                    videoConteudo = ?,
                    linkConteudo = ?
                WHERE idConteudo = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bind_param(
            "sssssi",
            $titulo,
            $texto,
            $imagem,
            $video,
            $link,
            $id
        );

        return $stmt->execute();
    }

    public function excluir($id) {
        $sql = "DELETE FROM conteudo WHERE idConteudo = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}
?>