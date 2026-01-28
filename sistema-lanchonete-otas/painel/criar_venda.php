<?php

require_once '../proteger.php';
require_once '../conexao.php';

$nome = $_SESSION['funcionario_nome'];
$funcionario_id = $_SESSION['funcionario_id'];
$mensagem = '';
$tipo_mensagem = '';
$produtos = buscaTodosProdutos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itens = $_POST['itens'] ?? [];
    $total = 0;
    $tem_erros = false;

    foreach ($itens as $item) {
        if (!empty($item['produto_id']) && !empty($item['quantidade'])) {
            $produto = buscaProduto($item['produto_id']);
            if (!$produto) {
                $tem_erros = true;
                break;
            }
            if ($item['quantidade'] > $produto['quantidade_estoque']) {
                $mensagem = 'Produto ' . htmlspecialchars($produto['nome']) . ' não possui estoque suficiente!';
                $tipo_mensagem = 'error';
                $tem_erros = true;
                break;
            }
            $total += $item['quantidade'] * $produto['preco'];
        }
    }

    if (!$tem_erros && $total > 0) {
        $venda_id = insereVenda($funcionario_id, $total);

        foreach ($itens as $item) {
            if (!empty($item['produto_id']) && !empty($item['quantidade'])) {
                $produto = buscaProduto($item['produto_id']);
                insereItemVenda($venda_id, $item['produto_id'], $item['quantidade'], $produto['preco']);
            }
        }

        $mensagem = 'Venda criada com sucesso!';
        $tipo_mensagem = 'success';
    } elseif ($total === 0) {
        $mensagem = 'Adicione pelo menos um item à venda!';
        $tipo_mensagem = 'error';
    } elseif (!$tem_erros && empty($mensagem)) {
        $mensagem = 'Erro ao criar venda!';
        $tipo_mensagem = 'error';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Venda - Lanchonete Ota's</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
    <link rel="stylesheet" href="../assets/css/crud.css">
    <link rel="stylesheet" href="../assets/css/venda.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="../painel.php" style="text-decoration: none; color: inherit;">
                <h1>🍔 Lanchonete Ota's</h1>
            </a>
            <nav>
                <span>👤 <?= htmlspecialchars($nome) ?></span>
                <a href="../sair.php">🚪 Sair</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div style="margin-bottom: 20px;">
            <a href="vendas.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px; display: inline-block;">⬅️ Voltar</a>
        </div>
        <div class="form-container">
            <h2>Criar Nova Venda</h2>

            <?php if (!empty($mensagem)): ?>
                <div class="alert-<?= $tipo_mensagem ?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="POST" id="vendaForm">
                <div class="form-group">
                    <label><strong>Funcionário:</strong> <?= htmlspecialchars($nome) ?></label>
                </div>

                <h3 style="color: #333; margin-top: 30px; margin-bottom: 15px;">Itens da Venda</h3>

                <div id="itens-container">
                    <div class="item-row">
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Produto</label>
                            <select name="itens[0][produto_id]" onchange="atualizarTotal()" oninput="atualizarTotal()">
                                <option value="">-- Selecione um produto --</option>
                                <?php foreach ($produtos as $p): ?>
                                    <option value="<?= $p['id'] ?>">
                                        <?= htmlspecialchars($p['nome']) ?> (Est: <?= $p['quantidade_estoque'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Preço Unit.</label>
                            <input type="text" name="itens[0][preco_unit]" readonly style="background: #f5f5f5; cursor: not-allowed;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Quantidade</label>
                            <input type="number" name="itens[0][quantidade]" min="1" value="" onchange="atualizarTotal()" oninput="atualizarTotal()">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 5px; font-size: 12px;">Subtotal</label>
                            <input type="text" name="itens[0][subtotal]" readonly style="background: #f5f5f5; cursor: not-allowed;">
                        </div>
                        <div>
                            <button type="button" class="btn-remove" onclick="removerItem(event)">Remover</button>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-add-item" onclick="adicionarItem()">➕ Adicionar Item</button>

                <div class="total-box">
                    <h3>Total da Venda</h3>
                    <div class="total-amount" id="total">R$ 0,00</div>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-salvar">💾 Finalizar Venda</button>
                    <a href="vendas.php" class="btn-cancelar" style="padding: 14px; text-align: center; text-decoration: none;">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>

    <script>
        // Passa os produtos do PHP para JavaScript
        window.produtosGlobais = <?= json_encode($produtos); ?>;
    </script>
    <script src="../assets/js/venda.js"></script>
</body>

</html>
