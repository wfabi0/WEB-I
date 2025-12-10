function funcao01() {
  const ob1 = { nome: "João", idade: 45 };
  const { nome } = ob1;
  const ob2 = { ...ob1, cidade: "Paris" };
  console.log(ob2);
}

function funcao02(obj) {
  const { id } = obj;
  if (id > 10) {
    alert("Maior");
  } else {
    alert("Menor")
  }
}

export { funcao01, funcao02 };
