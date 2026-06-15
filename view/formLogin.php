<?php include "header.php"; ?>

    <?php
        $errosLogin = $_SESSION["errosLogin"] ?? [];
    ?>

    <?php if(!empty($errosLogin)): ?>

    <div class="modal-erro" id="modalErro">
        <div class="modal-conteudo">

            <h3>
                <i class="fa-solid fa-triangle-exclamation"></i>
                Atenção
            </h3>

            <?php foreach($errosLogin as $erro): ?>
                <p><?= $erro ?></p>
            <?php endforeach; ?>

            <button id="fecharModal">
                Fechar
            </button>

        </div>
    </div>

    <?php
        unset($_SESSION["errosLogin"]);
        endif;
    ?>

    <script src="../assets/JS/form.js" defer></script>

    <!-- Seção de contato -->
    <section class="contact" id="formLogin">
        <h2 class="section-title">Iniciar sessão</h2>
        <div>
            <div class="contact-form">
                <form id="contactForm" action="../controller/actionLogin.php" method="post">
                    <div class="form-group">
                        <label for="emailUsuario">E-mail</label>
                        <input type="email" id="emailUsuario" name="emailUsuario" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="form-group">
                        <label for="senhaUsuario">Senha</label>
                        <div class="senha-box">
                            <input type="password" id="senhaUsuario" name="senhaUsuario" placeholder="Digite sua senha" required>

                            <button type="button" class="toggle-senha" data-campo="senhaUsuario">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="link-direita">
                            <a href="#privacy">Esqueceu a senha?</a>
                        </div>
                    </div>

                    <label class="lembrar-de-mim">
                        <input type="checkbox">
                        <div class="check"></div>
                        <span>Lembrar de mim</span>
                    </label><br><br>

                    <button type="submit" class="submit-btn">Entrar</button>

                    <hr>

                    <div class="link-centro">Ainda não possui cadastro? <a href="formUsuario.php">Clique aqui!</a></div>
                </form>
            </div>
        </div>
    </section>

<?php include "footer.php" ?>
