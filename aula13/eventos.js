function cliqueBotao01() {
  alert("Clicado");
}

// Forma intermediaria

// const b1 = document.querySelector("main button");
// b1.onclick = cliqueBotao01;

const bt = document.querySelector("main button");
bt.addEventListener("click", (event) => {
    console.log(event)
    console.log(event.target)
    alert("Clicado com addEventListener");
});