// PARTICLES
const particles = document.getElementById("particles");

if (particles) {
    for (let i = 0; i < 30; i++) {
        const p = document.createElement("div");
        p.className = "particle";
        p.style.left = Math.random() * 100 + "%";
        particles.appendChild(p);
    }
}

// TEXT ROTATION
const textSets = document.querySelectorAll(".text-set");

if (textSets.length > 0) {
    let index = 0;

    setInterval(() => {
        textSets[index].classList.remove("active");
        index = (index + 1) % textSets.length;
        textSets[index].classList.add("active");
    }, 5000);
}