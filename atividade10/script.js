import { createCepHandler } from "./api.js";

let registros = [];

const form = document.getElementById("cadastroForm");
const corpoTabela = document.getElementById("corpoTabela");

const cepInput = document.getElementById("cep");
const logradouroInput = document.getElementById("logradouro");
const numeroInput = document.getElementById("numero");
const bairroInput = document.getElementById("bairro");
const cidadeInput = document.getElementById("cidade");
const estadoInput = document.getElementById("estado");

form.addEventListener("submit", function (event) {
  event.preventDefault();
  cadastrarRegistro();
});

function setAddressReadonly(value) {
  logradouroInput.readOnly = value;
  bairroInput.readOnly = value;
  cidadeInput.readOnly = value;
  estadoInput.readOnly = value;
}

function clearAddressFields() {
  logradouroInput.value = "";
  bairroInput.value = "";
  cidadeInput.value = "";
  estadoInput.value = "";
}

cepInput.addEventListener(
  "blur",
  createCepHandler({
    logradouroInput,
    bairroInput,
    cidadeInput,
    estadoInput,
    setAddressReadonly,
    clearAddressFields,
  })
);

function cadastrarRegistro() {
  const nome = document.getElementById("nome").value.trim();
  const email = document.getElementById("email").value.trim();
  const telefone = document.getElementById("telefone").value.trim();
  const dataNascimento = document.getElementById("dataNascimento").value;
  const cep = cepInput.value.trim();
  const logradouro = logradouroInput.value.trim();
  const numero = numeroInput.value.trim();
  const bairro = bairroInput.value.trim();
  const cidade = cidadeInput.value.trim();
  const estado = estadoInput.value.trim();

  let endereco = "";
  if (logradouro) endereco += logradouro;
  if (numero) endereco += (endereco ? ", " : "") + numero;
  if (bairro) endereco += (endereco ? " - " : "") + bairro;
  if (cidade) endereco += (endereco ? " - " : "") + cidade;
  if (estado) endereco += (endereco ? " - " : "") + estado;
  if (cep) endereco += (endereco ? " (" : "") + cep + (endereco ? ")" : "");

  const novoRegistro = {
    nome,
    email,
    telefone,
    dataNascimento,
    endereco,
  };

  registros.push(novoRegistro);

  atualizarTabela();

  form.reset();
  setAddressReadonly(false);
}

function atualizarTabela() {
  corpoTabela.innerHTML = "";

  if (registros.length === 0) {
    const linhaVazia = `
                    <tr class="empty-table-message">
                        <td colspan="6">
                            Nenhum registro cadastrado.
                        </td>
                    </tr>
                `;
    corpoTabela.innerHTML = linhaVazia;
    return;
  }

  registros.forEach((registro, index) => {
    const row = corpoTabela.insertRow();

    let cellNome = row.insertCell();
    cellNome.textContent = registro.nome;

    let cellEmail = row.insertCell();
    cellEmail.className = "hidden-sm";
    cellEmail.textContent = registro.email;

    let cellTelefone = row.insertCell();
    cellTelefone.className = "hidden-md";
    cellTelefone.textContent = registro.telefone;

    let cellDataNascimento = row.insertCell();
    cellDataNascimento.className = "hidden-lg";
    cellDataNascimento.textContent = registro.dataNascimento;

    let cellEndereco = row.insertCell();
    cellEndereco.className = "hidden-sm";
    cellEndereco.textContent = registro.endereco;

    let cellAcoes = row.insertCell();
    cellAcoes.className = "action-cell";

    const btnExcluir = document.createElement("button");
    btnExcluir.textContent = "Excluir";
    btnExcluir.className = "delete-button";
    btnExcluir.dataset.index = index;

    cellAcoes.appendChild(btnExcluir);
  });
}

function excluirRegistro(index) {
  registros.splice(index, 1);
  atualizarTabela();
}

document.addEventListener("DOMContentLoaded", atualizarTabela);

corpoTabela.addEventListener("click", function (event) {
  const target = event.target;
  if (target && target.matches(".delete-button")) {
    const idx = Number(target.dataset.index);
    if (!Number.isNaN(idx)) {
      excluirRegistro(idx);
    }
  }
});
