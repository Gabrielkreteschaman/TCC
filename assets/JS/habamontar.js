document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll(".tab-item");
    const panels = document.querySelectorAll(".content-panel");

    let ativo = document.querySelector(".content-panel.active");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {

            if (tab.classList.contains("active")) return;

            const targetId = tab.getAttribute("data-tab");
            const novo = document.getElementById(targetId);

            // troca botão ativo
            tabs.forEach(t => t.classList.remove("active"));
            tab.classList.add("active");

            if (ativo) {
                ativo.classList.add("saindo");

                setTimeout(() => {
                    ativo.classList.remove("active", "saindo");
                }, 400);
            }

            // entra novo com pequeno delay (crossfade)
            setTimeout(() => {
                novo.classList.add("active");
                ativo = novo;
            }, 50);
        });
    });
});

document.querySelectorAll(".tab-item").forEach(tab => {
    tab.addEventListener("click", () => {

        document.querySelectorAll(".tab-item")
            .forEach(t => t.classList.remove("active"));

        document.querySelectorAll(".content-panel")
            .forEach(p => p.classList.remove("active"));

        tab.classList.add("active");

        const id = tab.dataset.tab;
        document.getElementById(id).classList.add("active");
    });
});