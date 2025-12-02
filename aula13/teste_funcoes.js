function funcao1(par1, par2) {
  const s = par1 + par2;
  console.log(s);
}

const f2 = function funcao2() {
  console.log("Função 02");
};

const f3 = function () {
  console.log("Funcao 03");
};

const f4 = () => {
  console.log("Função 04");
};

const f5 = (n) => 2 * n;

const f6 = (n) => 2 * n;

funcao1(10, 20);
f2();
f3();
f4();
console.log(f5(5));
console.log(f6(6));

// Passagem de funções como parâmetros
function executora(fun) {
  fun();
}

function funcao7() {
  console.log("Funcao 07");
}
executora(funcao7);

const f8 = function () {
  console.log("Função 08");
};
executora(f8);

const f9 = function () {
  console.log("Função 09");
};
executora(f9);

executora(function () {
  console.log("Função 10");
});

executora(() => {
  console.log("Função 11");
});
0