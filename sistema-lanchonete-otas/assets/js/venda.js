const produtos = window.produtosGlobais || [];
let itemCount = 1;

function atualizarTotal() {
  let total = 0;
  document.querySelectorAll(".item-row").forEach((row) => {
    const selectProduto = row.querySelector('select[name*="produto_id"]');
    const inputQtd = row.querySelector('input[name*="quantidade"]');
    const inputSubtotal = row.querySelector('input[name*="subtotal"]');
    const inputPreco = row.querySelector('input[name*="preco_unit"]');

    if (selectProduto && selectProduto.value) {
      const produto = produtos.find((p) => p.id == selectProduto.value);

      if (produto) {
        const preco = parseFloat(produto.preco);

        if (inputPreco) {
          inputPreco.value = "R$ " + preco.toFixed(2).replace(".", ",");
        }

        if (inputQtd && inputQtd.value) {
          const subtotal = preco * parseFloat(inputQtd.value);
          if (inputSubtotal) {
            inputSubtotal.value = "R$ " + subtotal.toFixed(2).replace(".", ",");
          }
          total += subtotal;
        } else {
          if (inputSubtotal) {
            inputSubtotal.value = "";
          }
        }
      }
    } else {
      if (inputPreco) inputPreco.value = "";
      if (inputSubtotal) inputSubtotal.value = "";
    }
  });

  const totalElement = document.getElementById("total");
  if (totalElement) {
    totalElement.innerText = "R$ " + total.toFixed(2).replace(".", ",");
  }
}

function adicionarItem() {
  const container = document.getElementById("itens-container");
  const novaLinha = document.createElement("div");
  novaLinha.className = "item-row";

  let opcoesHTML = '<option value="">-- Selecione um produto --</option>';
  produtos.forEach((p) => {
    opcoesHTML += `<option value="${p.id}">${p.nome} (Est: ${p.quantidade_estoque})</option>`;
  });

  novaLinha.innerHTML = `
        <div>
            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Produto</label>
            <select name="itens[${itemCount}][produto_id]" onchange="atualizarTotal()" oninput="atualizarTotal()">
                ${opcoesHTML}
            </select>
        </div>
        <div>
            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Preço Unit.</label>
            <input type="text" name="itens[${itemCount}][preco_unit]" readonly style="background: #f5f5f5; cursor: not-allowed;">
        </div>
        <div>
            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Quantidade</label>
            <input type="number" name="itens[${itemCount}][quantidade]" min="1" value="" onchange="atualizarTotal()" oninput="atualizarTotal()">
        </div>
        <div>
            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Subtotal</label>
            <input type="text" name="itens[${itemCount}][subtotal]" readonly style="background: #f5f5f5; cursor: not-allowed;">
        </div>
        <div>
            <button type="button" class="btn-remove" onclick="removerItem(event)">Remover</button>
        </div>
    `;

  container.appendChild(novaLinha);
  itemCount++;
}

function removerItem(event) {
  event.preventDefault();
  const items = document.querySelectorAll(".item-row");
  if (items.length > 1) {
    event.target.closest(".item-row").remove();
    atualizarTotal();
  } else {
    alert("Você deve manter pelo menos um item!");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const selectPrimeiro = document.querySelector("select");
  const inputQtdPrimeiro = document.querySelector(
    'input[name="itens[0][quantidade]"]',
  );

  if (selectPrimeiro) {
    selectPrimeiro.addEventListener("change", atualizarTotal);
  }
  if (inputQtdPrimeiro) {
    inputQtdPrimeiro.addEventListener("change", atualizarTotal);
  }
});
