<?php
    session_start();

    $erros = $_SESSION["errosCadastro"] ?? [];

    unset($_SESSION["errosCadastro"]);
?>
<?php include 'header.php' ?>

    <script src="../assets/JS/form.js" defer></script>
    <script src="../assets/JS/teste.js" defer></script>

    <!-- Alerta ao inserir e-mail ou imagem já existentes -->
     <?php if(!empty($erros)): ?>
        <div class="modal-erro" id="modalErro">
            <div class="modal-conteudo">

                <h3>
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Atenção
                </h3>

                <?php foreach($erros as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>

                <button id="fecharModal">
                    Fechar
                </button>

            </div>
        </div>
    <?php endif; ?>
    <section class="contact" id="formCadastro">
        <h2 class="section-title">Cadastro</h2>
        <div>
            <div class="contact-form">
                <form id="contactForm" action="../controller/actionUsuario.php" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="fotoUsuario">Foto</label>
                        <label for="fotoUsuario" class="fotobonito" id="btnFoto">
                            <i class="fa-solid fa-camera"></i>
                            <span>Adicionar foto</span>
                            <small>JPG, PNG até 5 MB</small>
                        </label>
                    </div>

                    <input type="file" id="fotoUsuario" name="fotoUsuario" accept="image/*" hidden>


                    <div id="preview-container"></div>
                    <div class="form-group">
                        <label for="nomeUsuario">Nome</label>
                        <input type="text" id="nomeUsuario" name="nomeUsuario" placeholder="Digite seu nome" >
                    </div>
                    <div class="form-group">
                        <label for="emailUsuario">E-mail</label>
                        <input type="email" id="emailUsuario" name="emailUsuario" placeholder="Digite seu e-mail" >
                    </div>
                    <div class="form-group">
                        <label for="senhaUsuario">Senha</label>
                        <div class="senha-box">
                            <input type="password" id="senhaUsuario" name="senhaUsuario" placeholder="Digite sua senha" >

                            <button type="button"
                                    class="toggle-senha"
                                    data-campo="senhaUsuario">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>   
                        <div class="senha-help">
                            <div class="senha-status">
                                <div class="forca-barra">
                                    <div class="forca-progresso" id="forcaBarra"></div>
                                </div>
                                <span id="forcaTexto"><strong>SENHA:</strong></span>
                            </div>
                            <div class="senha-requisitos">
                                <span id="req-length">mínimo 6 caracteres,</span>
                                <span id="req-maiuscula">1 letra maiúscula,</span> 
                                <span id="req-numero">1 número e</span>
                                <span id="req-especial">1 caractere especiail.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmaSenha">Confirma senha</label>
                        <div class="senha-box">
                            <input type="password" id="confirmaSenha" name="confirmaSenha" placeholder="Confirme sua senha" >

                            <button type="button"
                                    class="toggle-senha"
                                    data-campo="confirmaSenha">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="senha-help">
                            <div class="senha-status"></div>
                            <div id="erroConfirma" class="erro-msg"></div>

                            <div class="senha-dica">
                                A <strong>SENHA</strong> deve ser igual à anterior.
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Cadastrar</button>
                </form>
            </div>
        </div>
    </section>

<?php include 'footer.php' ?>