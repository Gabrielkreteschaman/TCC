function abrirEditarPerfil() {
    const modal = document.getElementById("modalEditar");

    if (modal) {
        modal.style.display = "flex";
    }
}

function fecharEditarPerfil() {
    const modal = document.getElementById("modalEditar");

    if (modal) {
        modal.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", () => {

    document.querySelectorAll("#modalEditar .toggle-senha").forEach(botao => {
        botao.addEventListener("click", () => {

            const campo = document.getElementById(botao.dataset.campo);

            if (!campo) return;

            if (campo.type === "password") {
                campo.type = "text";
                botao.innerHTML = '<i class="bi bi-eye-slash"></i>';
                botao.classList.add("ativo");
            } else {
                campo.type = "password";
                botao.innerHTML = '<i class="bi bi-eye"></i>';
                botao.classList.remove("ativo");
            }

        });
    });

    const inputFoto = document.getElementById("fotoUsuarioEditar");
    const previewFoto = document.getElementById("previewFotoEditar");

    if (inputFoto && previewFoto) {
        inputFoto.addEventListener("change", () => {
            const arquivo = inputFoto.files[0];

            if (arquivo) {
                previewFoto.src = URL.createObjectURL(arquivo);
            }
        });
    }

    const formEditar = document.querySelector("#modalEditar form");
    const novaSenha = document.getElementById("novaSenhaPerfil");
    const confirmaSenha = document.getElementById("confirmaSenhaPerfil");
    const erroConfirma = document.getElementById("erroConfirmaPerfil");

    if (formEditar && novaSenha && confirmaSenha) {
        formEditar.addEventListener("submit", (e) => {

            if (novaSenha.value !== confirmaSenha.value) {
                e.preventDefault();

                if (erroConfirma) {
                    erroConfirma.textContent = "As senhas não são iguais.";
                    erroConfirma.classList.add("show");
                }

                confirmaSenha.style.borderColor = "#ff4d6d";
                confirmaSenha.focus();
            }

        });
    }

});