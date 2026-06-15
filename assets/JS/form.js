document.addEventListener("DOMContentLoaded", () => {

    // =========================
    // TOGGLE MOSTRAR SENHA
    // =========================
    document.addEventListener("click", function (e) {

        const botao = e.target.closest(".toggle-senha");
        if (!botao) return;

        console.log("CLICOU NA LUNETA");

        const campoId = botao.getAttribute("data-campo");
        const input = document.getElementById(campoId);
        const icon = botao.querySelector("i");

        if (!input || !icon) return;

        const mostrar = input.type === "password";

        input.type = mostrar ? "text" : "password";

        icon.classList.toggle("bi-eye", !mostrar);
        icon.classList.toggle("bi-eye-slash", mostrar);

        botao.classList.toggle("ativo", mostrar);

        botao.classList.add("trocando");
        setTimeout(() => botao.classList.remove("trocando"), 150);
    });

    // =========================
    // FORÇA DA SENHA
    // =========================
    const senha = document.getElementById("senhaUsuario");
    const confirma = document.getElementById("confirmaSenha");
    const barra = document.getElementById("forcaBarra");
    const texto = document.getElementById("forcaTexto");

    if (senha) {
        senha.addEventListener("input", () => {

            const reqLength = document.getElementById("req-length");
            const reqMaiuscula = document.getElementById("req-maiuscula");
            const reqNumero = document.getElementById("req-numero");
            const reqEspecial = document.getElementById("req-especial");

            const valor = senha.value;

            const temEspecial = /[^a-zA-Z0-9]/.test(valor);
            const temLength = valor.length >= 6;
            const temMaiuscula = /[A-Z]/.test(valor);
            const temNumero = /[0-9]/.test(valor);
            const temLetra = /[a-zA-Z]/.test(valor);

            reqEspecial?.classList.toggle("ok", temEspecial);
            reqLength?.classList.toggle("ok", temLength);
            reqMaiuscula?.classList.toggle("ok", temMaiuscula);
            reqNumero?.classList.toggle("ok", temNumero);

            if (!barra || !texto) return;

            if (valor.length === 0) {
                barra.style.width = "0%";
                barra.style.background = "transparent";
                texto.innerHTML = "<strong>SENHA:</strong>";
                return;
            }

            if (!temLetra) {
                barra.style.width = "20%";
                barra.style.background = "#ff4d4d";
                texto.innerHTML = "<strong>SENHA INVÁLIDA</strong>";
                return;
            }

            if (!temLength || !temMaiuscula || !temNumero || !temEspecial) {
                barra.style.width = "33%";
                barra.style.background = "#ff4d4d";
                texto.innerHTML = "<strong>SENHA FRACA</strong>";
                return;
            }

            barra.style.width = "100%";
            barra.style.background = "#00B2FF";
            texto.innerHTML = "<strong>SENHA FORTE</strong>";
        });
    }


    // =========================
    // CONFIRMA SENHA
    // =========================
    const erroConfirma = document.getElementById("erroConfirma");

    function validarSenha() {
        if (!senha || !confirma || !erroConfirma) return;

        if (confirma.value.length === 0) {
            erroConfirma.innerHTML = "";
            erroConfirma.classList.remove("show", "ok");
            return;
        }

        if (confirma.value !== senha.value) {
            erroConfirma.innerHTML = "AS SENHAS NÃO COINCIDEM";
            erroConfirma.classList.remove("ok");
            erroConfirma.classList.add("show");
        } else {
            erroConfirma.innerHTML = "✔ SENHAS IGUAIS";
            erroConfirma.classList.remove("show");
            erroConfirma.classList.add("ok");
        }
    }

    confirma?.addEventListener("input", validarSenha);
    senha?.addEventListener("input", validarSenha);


    // =========================
    // SUBMIT FORM
    // =========================
    document.querySelectorAll("form").forEach((form) => {
        form.addEventListener("submit", function (e) {

            const senha = form.querySelector("#senhaUsuario");
            const confirma = form.querySelector("#confirmaSenha");
            const erroConfirma = form.querySelector("#erroConfirma");

            // só valida se existir campo de confirmação (cadastro)
            if (senha && confirma && senha.value !== confirma.value) {
                e.preventDefault();

                if (erroConfirma) {
                    erroConfirma.innerHTML = "AS SENHAS NÃO COINCIDEM";
                    erroConfirma.classList.add("show");
                    erroConfirma.classList.remove("ok");
                }
            }
        });
    });

    // =========================
    // ALERTA AO INSERIR E-MAIL OU IMAGEM JÁ EXISTENTES
    // =========================
    const fecharModal = document.getElementById("fecharModal");
    if(fecharModal){

        fecharModal.addEventListener("click", () => {

            document.getElementById("modalErro").remove();

        });

    }
    window.addEventListener("click", (e) => {
        const modal = document.getElementById("modalErro");

        if(e.target === modal){
            modal.remove();
        }

    });
    document.addEventListener("keydown", (e) => {

        if(e.key === "Escape"){

            const modal = document.getElementById("modalErro");

            if(modal){
                modal.remove();
            }
        }

    });

    // =========================
    // ALERTA AO INSERIR E-MAIL OU SENHA NO LOGIN
    // =========================
    function fecharModalErro(){
        document.querySelector(".modal-erro").style.display = "none";
    }

});