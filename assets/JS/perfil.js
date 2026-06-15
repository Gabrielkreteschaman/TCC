document.addEventListener("DOMContentLoaded", () => {
    const senha = document.getElementById("novaSenhaPerfil");
    const confirma = document.getElementById("confirmaSenhaPerfil");
    const barra = document.getElementById("forcaBarraPerfil");
    const texto = document.getElementById("forcaTextoPerfil");
    const erro = document.getElementById("erroConfirmaPerfil");

    const reqLength = document.getElementById("req-length-perfil");
    const reqMaiuscula = document.getElementById("req-maiuscula-perfil");
    const reqNumero = document.getElementById("req-numero-perfil");
    const reqEspecial = document.getElementById("req-especial-perfil");

    senha?.addEventListener("input", () => {
        const valor = senha.value;

        const temLength = valor.length >= 6;
        const temMaiuscula = /[A-Z]/.test(valor);
        const temNumero = /[0-9]/.test(valor);
        const temEspecial = /[^a-zA-Z0-9]/.test(valor);
        const temLetra = /[a-zA-Z]/.test(valor);

        reqLength?.classList.toggle("ok", temLength);
        reqMaiuscula?.classList.toggle("ok", temMaiuscula);
        reqNumero?.classList.toggle("ok", temNumero);
        reqEspecial?.classList.toggle("ok", temEspecial);

        if (valor.length === 0) {
            barra.style.width = "0%";
            texto.innerHTML = "<strong>SENHA:</strong>";
        } else if (!temLetra) {
            barra.style.width = "20%";
            barra.style.background = "#ff4d4d";
            texto.innerHTML = "<strong>SENHA INVÁLIDA</strong>";
        } else if (!temLength || !temMaiuscula || !temNumero || !temEspecial) {
            barra.style.width = "33%";
            barra.style.background = "#ff4d4d";
            texto.innerHTML = "<strong>SENHA FRACA</strong>";
        } else {
            barra.style.width = "100%";
            barra.style.background = "#00B2FF";
            texto.innerHTML = "<strong>SENHA FORTE</strong>";
        }

        validarConfirmaPerfil();
    });

    confirma?.addEventListener("input", validarConfirmaPerfil);

    function validarConfirmaPerfil() {
        if (!senha || !confirma || !erro) return;

        if (confirma.value.length === 0) {
            erro.innerHTML = "";
            erro.classList.remove("show", "ok");
            return;
        }

        if (confirma.value !== senha.value) {
            erro.innerHTML = "AS SENHAS NÃO COINCIDEM";
            erro.classList.add("show");
            erro.classList.remove("ok");
        } else {
            erro.innerHTML = "✔ SENHAS IGUAIS";
            erro.classList.remove("show");
            erro.classList.add("ok");
        }
    }
});
document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll("#modalEditar .toggle-senha").forEach((botao) => {

        botao.addEventListener("click", () => {

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
            setTimeout(() => {
                botao.classList.remove("trocando");
            }, 150);

        });

    });

});
const fecharModalPerfil = document.getElementById("fecharModalPerfil");

if (fecharModalPerfil) {
    fecharModalPerfil.addEventListener("click", () => {
        document.getElementById("modalErroPerfil").remove();
    });
}

window.addEventListener("click", (e) => {
    const modalPerfil = document.getElementById("modalErroPerfil");

    if (e.target === modalPerfil) {
        modalPerfil.remove();
    }
});

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        const modalPerfil = document.getElementById("modalErroPerfil");

        if (modalPerfil) {
            modalPerfil.remove();
        }
    }
});