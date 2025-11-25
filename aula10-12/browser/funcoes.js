function entrada() {
  let confirmar = confirm("Confirma?");
  console.log(confirmar);
  let digitado = prompt("Digite ai.");
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
  let h = `${f} e ${g} são primos`;
  console.log(typeof a, a);
  console.log(typeof b, b);
  console.log(typeof c, c);
  console.log(typeof d, d);
  console.log(typeof e, e);
  console.log(typeof f, f);
  console.log(typeof g, g);
  console.log(typeof h, h);
}
