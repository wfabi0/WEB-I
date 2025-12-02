function cliqueBotao01() {
  alert("Clicado");
}

// Forma intermediaria

// const b1 = document.querySelector("main button");
// b1.onclick = cliqueBotao01;

const bts = document.querySelectorAll("main button");

bts.forEach((v) => {
  v.addEventListener("click", (event) => {
    console.log(event);
    console.log(event.target);
    alert("Clicado com addEventListener");
    event.target.textContext = "Já clicado";
    alert("Clicado novo");
  });
});
