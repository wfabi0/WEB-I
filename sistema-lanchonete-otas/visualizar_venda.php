<?php

require_once './proteger.php';
require_once './conexao.php';

$nome = $_SESSION['funcionario_nome'];

$id = $_GET['id'] ?? '';
if (empty($id)) {
    header('Location: vendas.php');
    exit;
}

$venda = buscaVenda($id);
if (!$venda) {
    header('Location: vendas.php');
    exit;
}

$itens = buscaItensVenda($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Venda - Lanchonete Ota's</title>
    <link rel="stylesheet" href="assets/css/painel.css">
    <link rel="stylesheet" href="assets/css/crud.css">
    <link rel="stylesheet" href="assets/css/visualizar_venda.css">
</head>

<body>
    <header>
        <div class="header-content">
            <a href="painel.php" style="text-decoration: none; color: inherit;">
                <h1>🍔 Lanchonete Ota's</h1>
            </a>
            <nav>
                <span>👤 <?= htmlspecialchars($nome) ?></span>
                <a href="sair.php">🚪 Sair</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div style="margin-bottom: 20px;">
            <a href="vendas.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px; display: inline-block;">⬅️ Voltar</a>
        </div>

        <div class="detalhes-venda">
            <h2 style="color: #333; margin-bottom: 30px;">Detalhes da Venda #<?= htmlspecialchars($venda['id']) ?></h2>

            <div class="info-grid">
                <div class="info-item">
                    <label>ID da Venda</label>
                    <span><?= htmlspecialchars($venda['id']) ?></span>
                </div>
                <div class="info-item">
                    <label>Funcionário</label>
                    <span><?= htmlspecialchars($venda['funcionario_id']) ?></span>
                </div>
                <div class="info-item">
                    <label>Data da Venda</label>
                    <span><?= date('d/m/Y H:i:s', strtotime($venda['data_venda'])) ?></span>
                </div>
                <div class="info-item">
                    <label>Total</label>
                    <span style="color: #FF9500; font-size: 20px;">R$ <?= number_format($venda['total'], 2, ',', '.') ?></span>
                </div>
            </div>

            <h3 style="color: #333; margin-bottom: 20px; margin-top: 40px;">Itens da Venda</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço Unitário</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($itens as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nome']) ?></td>
                                <td><?= htmlspecialchars($item['quantidade']) ?></td>
                                <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                                <td>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>
</body>

</html>