// window.alert('Teste JS Browser')

function entradaBasica() {
  let confirmaçao = confirm("Confirma?");
  console.log(confirmaçao);
  let digitado = prompt("Digite algo");
  console.log(digitado);
}

function tipagem() {
  let a = 10;
  let b = 15.65;
  let c = true;
  let d = [];
  let e = {};
  let f = "Jonas";
  let g = "Augusto";
  let h = `${f} e ${g} sao primos`;
  console.log(typeof a, a);
  console.log(typeof b, b);
  console.log(typeof c, c);
  console.log(typeof d, d);
  console.log(typeof e, e);
  console.log(typeof f, f);
  console.log(typeof g, g);
  console.log(typeof h, h);
}

function variaveis() {
  let a = 10;
  console.log(typeof a, a);
  a = "Novo";
  console.log(typeof a, a);

  const b = 45;
  console.log(typeof b, b);
  //b=20 //gera erro
  // console.log(typeof b,b)

  const c = [1, 5, 9];
  console.log(typeof c, c);
  // c=[5,64,98]
  c[1] = 10;

  if (true) {
    var d = 45;
  }
  console.log(typeof d, d);
}

function desvios() {
  if (confirm("Fugir de casa? ")) {
    alert("va com deus");
  } else {
    alert("Fica meu filho!");
  }
}
function repeticao() {
  for (let i = 0; i < 10; i++) {
    console.log(i, ": ", i * i);
  }
  // }
  // while (condition) {

  //
  // do {

  // } while (condition);
}

function vetores() {
  const v1 = new Array(12, 25, 36, "Ana");
  console.log(v1);
  const v2 = ["Hilda", "Antunes", 65.96, 25];
  console.log(v2);
  v2.push("Novo");
  console.log(v2);

  console.log("For");
  for (let i = 0; i < v2.length; i++) {
    console.log(v2[i]);
  }
}
