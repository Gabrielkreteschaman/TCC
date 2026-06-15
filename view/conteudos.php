<?php

require_once "../model/Conteudo.php";

$conteudoModel = new Conteudo();

$resultado = $conteudoModel->listarTodos();

$conteudos = [];

while ($linha = $resultado->fetch_assoc()) {
    $conteudos[] = $linha;
}

include "header.php";

?>

<link rel="stylesheet" href="../assets/templatemo-electric-xtra.css">

<section class="features">

    <h2 class="section-title">
        Conteúdos Disponíveis
    </h2>

    <div class="conteudos-container">

        <aside class="menu-conteudos">

            <div class="menu-topo">

                <h3>Conteúdos</h3>

                <span id="contadorConteudos">
                    0
                </span>

            </div>

            <div id="menuConteudos"></div>

        </aside>

        <div
            class="visualizacao-conteudo"
            id="conteudoUsuario"
        >

        </div>

    </div>

</section>

<input
    type="hidden"
    id="dadosConteudos"
    value='<?= htmlspecialchars(
        json_encode(
            $conteudos,
            JSON_UNESCAPED_UNICODE
        ),
        ENT_QUOTES
    ) ?>'
>

<script src="../assets/JS/conteudos.js"></script>

<?php include "footer.php"; ?>