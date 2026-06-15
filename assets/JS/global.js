// MENU MOBILE
const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

if (menuToggle && navLinks) {
    menuToggle.onclick = () => {
        menuToggle.classList.toggle("active");
        navLinks.classList.toggle("active");
    };
}

// SCROLL NAVBAR
const navbar = document.getElementById("navbar");
window.addEventListener("scroll", () => {
    navbar?.classList.toggle("scrolled", window.scrollY > 50);
});

// Botão configuração do Perfil Usuario
function abrirMenuPerfil() {
    document.getElementById("menuPerfil").classList.add("ativo");
}

function fecharMenuPerfil() {
    document.getElementById("menuPerfil").classList.remove("ativo");
}

// Botão editar dados 
function abrirEditarPerfil() {
    document.getElementById("modalEditar").style.display = "flex";
}

function fecharEditarPerfil() {
    document.getElementById("modalEditar").style.display = "none";
}
const inputFotoEditar = document.getElementById("fotoUsuarioEditar");
const previewFotoEditar = document.getElementById("previewFotoEditar");

if (inputFotoEditar && previewFotoEditar) {
    inputFotoEditar.addEventListener("change", function () {
        const arquivo = this.files[0];

        if (arquivo) {
            previewFotoEditar.src = URL.createObjectURL(arquivo);
        }
    });
}
