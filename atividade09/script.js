let registros = [];

const form = document.getElementById("cadastroForm");
const corpoTabela = document.getElementById("corpoTabela");

form.addEventListener("submit", function (event) {
  event.preventDefault();
  cadastrarRegistro();
});

function cadastrarRegistro() {
  const nome = document.getElementById("nome").value.trim();
  const email = document.getElementById("email").value.trim();
  const telefone = document.getElementById("telefone").value.trim();
  const dataNascimento = document.getElementById("dataNascimento").value;
  const cidade = document.getElementById("cidade").value.trim();

  const novoRegistro = {
    nome,
    email,
    telefone,
    dataNascimento,
    cidade,
  };

  registros.push(novoRegistro);

  atualizarTabela();

  form.reset();
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

    let cellCidade = row.insertCell();
    cellCidade.className = "hidden-sm";
    cellCidade.textContent = registro.cidade;

    let cellAcoes = row.insertCell();
    cellAcoes.className = "action-cell";

    const btnExcluir = document.createElement("button");
    btnExcluir.textContent = "Excluir";
    btnExcluir.className = "delete-button";
    btnExcluir.onclick = () => excluirRegistro(index);

    cellAcoes.appendChild(btnExcluir);
  });
}

function excluirRegistro(index) {
  registros.splice(index, 1);
  atualizarTabela();
}

document.addEventListener("DOMContentLoaded", atualizarTabela);
