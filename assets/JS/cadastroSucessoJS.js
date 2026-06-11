let tempo = 15;

const contador = setInterval(() => {

    tempo--;

    document.getElementById("tempo").textContent = tempo;

    if (tempo <= 0) {
        clearInterval(contador);
        window.location.href = "index.php";
    }

}, 1000);