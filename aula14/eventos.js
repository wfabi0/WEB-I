import { funcao01, funcao02 } from "./testemodules.js";

const iptCep = document.querySelector("[name=cep]");
iptCep.addEventListener("input", (e) => {
  if (e.target.value.length == 8) {
    const cep = e.target.value;
    const res = fetch(`https://viacep.com.br/ws/${cep}/json/`);
    res
      .then((r) => {
        return r.json();
      })
      .then((dados) => {
        document.querySelector("[name=cidade]").value = dados.localidade;
      });
  }
});

const btTeste = document.querySelector("#btTeste");
btTeste.addEventListener("click", () => {
  funcao01();
});

const btTeste2 = document.querySelector("#btTeste2");
btTeste2.addEventListener("click", () => {
  funcao02({
    id: 12,
  });
});
