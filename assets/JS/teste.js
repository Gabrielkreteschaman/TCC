const btnFoto = document.getElementById("btnFoto");
const inputFoto = document.getElementById("fotoUsuario");
const preview = document.getElementById("preview-container");
const form = document.getElementById("contactForm");

if (btnFoto && inputFoto && preview && form) {

    inputFoto.addEventListener("change", () => {
        const file = inputFoto.files[0];

        if (!file) return;

        btnFoto.style.borderColor = "";
        btnFoto.style.boxShadow = "";

        btnFoto.querySelector("span").textContent = file.name;
        btnFoto.classList.add("arquivo-ok");

        const reader = new FileReader();

        reader.onload = (e) => {
            preview.innerHTML = `
                <div class="preview-box">
                    <img src="${e.target.result}" class="preview-img">
                </div>
            `;
        };

        reader.readAsDataURL(file);
    });

    form.addEventListener("submit", (e) => {

        const listaCampos = [
            {
                nome: "Foto",
                elemento: btnFoto,
                vazio: !inputFoto.files.length
            },
            {
                nome: "Nome",
                elemento: document.getElementById("nomeUsuario"),
                vazio: !document.getElementById("nomeUsuario").value.trim()
            },
            {
                nome: "E-mail",
                elemento: document.getElementById("emailUsuario"),
                vazio: !document.getElementById("emailUsuario").value.trim()
            },
            {
                nome: "Senha",
                elemento: document.getElementById("senhaUsuario"),
                vazio: !document.getElementById("senhaUsuario").value.trim()
            },
            {
                nome: "Confirmar senha",
                elemento: document.getElementById("confirmaSenha"),
                vazio: !document.getElementById("confirmaSenha").value.trim()
            }
        ];

        /* limpa vermelho antigo */
        listaCampos.forEach(campo => {
            campo.elemento.style.borderColor = "";
            campo.elemento.style.boxShadow = "";
        });

        const faltando = listaCampos.filter(c => c.vazio);

        if (faltando.length > 0) {

            e.preventDefault();

            /* pinta vermelho */
            faltando.forEach(campo => {

                campo.elemento.style.borderColor = "#ff4444";
                campo.elemento.style.boxShadow =
                    "0 0 18px rgba(255,68,68,.7)";
            });

            let mensagem = "";

            if (faltando.length === listaCampos.length) {

                mensagem = "Preencha todos os campos.";

            } else if (faltando.length === 1) {

                mensagem = `Preencha o campo ${faltando[0].nome}.`;

            } else {

                const nomes = faltando.map(c => c.nome);
                const ultimo = nomes.pop();

                mensagem =
                    `Preencha os campos ${nomes.join(", ")} e ${ultimo}.`;
            }

            alert(mensagem);
        }
    });
    const inputs = [
        document.getElementById("nomeUsuario"),
        document.getElementById("emailUsuario"),
        document.getElementById("senhaUsuario"),
        document.getElementById("confirmaSenha")
    ];

    inputs.forEach(input => {

        input.addEventListener("input", () => {

            if (input.value.trim()) {

                input.style.borderColor = "";
                input.style.boxShadow = "";

            }

        });

    });

    inputFoto.addEventListener("change", () => {

        if (inputFoto.files.length) {

            btnFoto.style.borderColor = "";
            btnFoto.style.boxShadow = "";

        }

    });
}