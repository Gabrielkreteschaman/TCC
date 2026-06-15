<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BuildEasy</title>

        <script src="../assets/JS/global.js" defer></script>
        <script src="../assets/JS/perfil.js" defer></script>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        
        <link rel="stylesheet" href="../assets/templatemo-electric-xtra.css">

        <!-- JQuery + máscaras -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <!--

        TemplateMo 596 Electric Xtra

        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="./templatemo-electric-xtra.css" rel="stylesheet">

        https://templatemo.com/tm-596-electric-xtra

        -->
    </head>
    <body>
        <!-- Fundo de grade animado -->
        <div class="grid-bg"></div>
        <div class="gradient-overlay"></div>
        <div class="scanlines"></div>

        <!-- Formas Animadas -->
        <div class="shapes-container">
            <div class="shape shape-circle"></div>
            <div class="shape shape-triangle"></div>
            <div class="shape shape-square"></div>
        </div>

        <!-- Partículas Flutuantes -->
        <div id="particles"></div>

        <!-- Navegação -->
        <nav id="navbar">
            <div class="nav-container">
                <a href="#home" class="logo-link">
                    <svg class="logo-svg" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#FF5E00;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#00B2FF;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <polygon points="20,2 38,14 38,26 20,38 2,26 2,14" fill="none" stroke="url(#logoGradient)" stroke-width="2"/>
                        <polygon points="20,8 32,16 32,24 20,32 8,24 8,16" fill="url(#logoGradient)" opacity="0.3"/>
                        <circle cx="20" cy="20" r="3" fill="url(#logoGradient)"/>
                    </svg>
                    <span class="logo-text">BUILDEASY</span>
                </a>
                <ul class="nav-links" id="navLinks">
                    <li><a href="index.php" class="nav-link">Página Inicial</a></li>

                    <?php if(isset($_SESSION["tipoUsuario"]) && $_SESSION["tipoUsuario"] == "admin"): ?>
                        <li><a href="editarConteudos.php" class="nav-link">Gerenciar conteúdo</a></li>
                    <?php endif; ?>

                    <li><a href="conteudos.php" class="nav-link">Como montar PC</a></li>

                    <?php if(isset($_SESSION["idUsuario"])): ?>
                        <li><a href="#" class="nav-link" onclick="abrirMenuPerfil(); return false;">Perfil</a></li>
                    <?php else: ?>
                        <li><a href="formLogin.php" class="nav-link">Login</a></li>
                    <?php endif; ?>

                </ul>
                <?php if(isset($_SESSION["idUsuario"])): ?>
                    <div class="menu-perfil" id="menuPerfil">

                        <button class="fechar-menu" onclick="fecharMenuPerfil()">×</button>

                        <div class="titulo-menu"><i class="bi bi-person-gear"></i><span>Meu Perfil</span></div>

                        <div class="card-perfil">
                            <h3 class="titulo-card-perfil"><span></span><i class="bi bi-person-circle"></i> Perfil Usuário<span></span></h3>
                            <img src="../assets/img/<?= $_SESSION["fotoUsuario"] ?>" class="foto-perfil" alt="Foto do perfil">
                            <p><?= $_SESSION["nomeUsuario"] ?></p>
                            <div class="botoes-perfil">
                                <a href="#" class="btn-editar-perfil" onclick="abrirEditarPerfil(); return false;"><i class="bi bi-pencil-square"></i> Editar Perfil</a>
                                <?php if($_SESSION["tipoUsuario"] != "admin"): ?>
                                    <a href="../controller/excluirPerfil.php" class="btn-excluir-perfil"><i class="bi bi-trash3"></i> Excluir Perfil</a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <a href="../controller/logout.php" class="btn-sair"><i class="bi bi-box-arrow-right"></i><span>Sair</span></a>
                    </div>
                <?php endif; ?>
                <div class="menu-toggle" id="menuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
        <?php
            $errosPerfil = $_SESSION["errosPerfil"] ?? [];
            unset($_SESSION["errosPerfil"]);
        ?>

        <?php if (!empty($errosPerfil)): ?>
            <div class="modal-erro" id="modalErroPerfil">
                <div class="modal-conteudo">

                    <h3>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        Atenção
                    </h3>

                    <?php foreach ($errosPerfil as $erro): ?>
                        <p><?= $erro ?></p>
                    <?php endforeach; ?>

                    <button id="fecharModalPerfil">
                        Fechar
                    </button>

                </div>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION["idUsuario"])): ?>
            <div class="modal-editar" id="modalEditar">
                <div class="modal-editar-conteudo">

                    <h2><i class="bi bi-pencil-square"></i> Editar Perfil</h2>

                    <form action="../controller/actionEditarPerfil.php" method="post" enctype="multipart/form-data">
                        <div class="foto-preview-area">
                            <img src="../assets/img/<?= $_SESSION["fotoUsuario"] ?>" class="preview-foto-editar" id="previewFotoEditar">
                            <label for="fotoUsuarioEditar" class="btn-upload-foto"><i class="bi bi-image"></i> Alterar foto</label>
                            <input type="file" id="fotoUsuarioEditar" name="fotoUsuario" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nomeUsuario" placeholder="Digite seu nome" value="<?= $_SESSION['nomeUsuario'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" name="emailUsuario" placeholder="Digite seu e-mail" value="<?= $_SESSION['emailUsuario'] ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Nova senha</label>
                            <div class="senha-box">
                                <input type="password" id="novaSenhaPerfil" name="novaSenha" placeholder="Digite uma nova senha">
                                <button type="button" class="toggle-senha" data-campo="novaSenhaPerfil"><i class="bi bi-eye"></i></button>
                            </div>

                            <div class="senha-help">
                                <div class="senha-status">
                                    <div class="forca-barra"><div class="forca-progresso" id="forcaBarraPerfil"></div></div>
                                    <span id="forcaTextoPerfil"><strong>SENHA:</strong></span>
                                </div>
                                <div class="senha-requisitos">
                                    <span id="req-length-perfil">mínimo 6 caracteres,</span>
                                    <span id="req-maiuscula-perfil">1 letra maiúscula,</span>
                                    <span id="req-numero-perfil">1 número e</span>
                                    <span id="req-especial-perfil">1 caractere especial.</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Confirmar senha</label>
                            <div class="senha-box">
                                <input type="password" id="confirmaSenhaPerfil" name="confirmaSenha" placeholder="Confirme sua senha">
                                <button type="button" class="toggle-senha" data-campo="confirmaSenhaPerfil"><i class="bi bi-eye"></i></button>
                            </div>

                            <div class="senha-help">
                                <div id="erroConfirmaPerfil" class="erro-msg"></div>
                                <div class="senha-dica">A <strong>SENHA</strong> deve ser igual à anterior.</div>
                            </div>
                        </div>

                        <div class="acoes-modal">
                            <button type="submit" class="btn-salvar">Salvar</button>
                            <button type="button" class="btn-cancelar" onclick="fecharEditarPerfil()">Cancelar</button>
                        </div>
                    </form>

                </div>
            </div>
        <?php endif; ?>