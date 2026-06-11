<?php
    class BD {

        private $host = "localhost";
        private $usuario = "root";
        private $senha = "";
        private $banco = "buildeasy";

        public function conectar() {
            $conexao = new mysqli(
                $this->host,
                $this->usuario,
                $this->senha,
                $this->banco
            );

            if ($conexao->connect_error) {
                die("Erro ao conectar: " . $conexao->connect_error);
            }

            return $conexao;
        }
        
    }
?>