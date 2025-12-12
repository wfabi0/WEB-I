function createCepHandler({
  logradouroInput,
  bairroInput,
  cidadeInput,
  estadoInput,
  setAddressReadonly,
  clearAddressFields,
}) {
  return function (event) {
    const cepValue = (event.target.value || "").replace(/\D/g, "");
    if (cepValue.length !== 8) {
      setAddressReadonly(false);
      return;
    }
    fetch(`https://viacep.com.br/ws/${cepValue}/json/`)
      .then((resp) => resp.json())
      .then((data) => {
        if (data.erro) {
          clearAddressFields();
          setAddressReadonly(false);
          return;
        }
        logradouroInput.value = data.logradouro || "";
        bairroInput.value = data.bairro || "";
        cidadeInput.value = data.localidade || "";
        estadoInput.value = data.uf || "";
        setAddressReadonly(true);
      })
      .catch(() => {
        clearAddressFields();
        setAddressReadonly(false);
      });
  };
}

export { createCepHandler };
