<?php
    $nome = $_GET["nome"] ?? "";
    $email = $_GET["email"] ?? "";
    $foto = $_GET["foto"] ?? "";
?>

<?php include 'header.php'; ?>

    <script src="../assets/JS/cadastroSucessoJS.js" defer></script>

    <section class="contact">

        <div class="sucesso-box">

            <div class="sucesso-check">
                <i class="fa-solid fa-check"></i>
            </div>

            <h2>Cadastro realizado com sucesso!</h2>

            <img src="../assets/img/<?php echo $foto; ?>" class="foto-sucesso" alt="Foto do usuário">

            <div class="dados">

                <div class="linha">
                    <span>👤 Nome</span>
                    <p><?php echo $nome; ?></p>
                </div>

                <div class="linha">
                    <span>📧 E-mail</span>
                    <p><?php echo $email; ?></p>
                </div>

                <div class="linha">
                    <span>🔒 Senha</span>
                    <p>Senha cadastrada com sucesso</p>
                </div>

            </div>

            <div class="contador-box">
                Redirecionando em <strong id="tempo">15</strong> segundos...
            </div>

            <a href="index.php" class="btn-sucesso">
                Ir para página inicial
            </a>

        </div>

    </section>

<?php include 'footer.php'; ?>