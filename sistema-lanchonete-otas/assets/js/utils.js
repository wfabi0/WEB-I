function confirmarDelecao(mensagem) {
  return confirm(mensagem);
}

const ConfirmacaoUtils = {
  deletarFuncionario() {
    return confirm("Tem certeza que deseja deletar este funcionário?");
  },
  deletarProduto() {
    return confirm("Tem certeza que deseja deletar este produto?");
  },
  deletarVenda() {
    return confirm(
      "Tem certeza que deseja deletar esta venda? O estoque será restaurado.",
    );
  },
};
