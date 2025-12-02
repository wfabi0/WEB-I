function testeArrays() {
  const v = ["Laranja", "Banana", "Pera"];
  console.table(v);
  v.push("Uva", "Abiu");
  const r = v.pop();
  console.log("Removido: ", r);
  console.table(r);
  v.unshift("Pitanga", "Uvaia", "Morango");
  console.table(v);
  const ri = v.shift();
  console.log("Removido: ", ri);
  console.table(v);
  v[2] = "Limão";
  console.table(v);
  v.slice(3, 1, "Abacaxi", "Cagaita");
  console.table(v);
  v.forEach((e, i) => {
    console.log(i + ": " + v);
  });
}

testeArrays();
