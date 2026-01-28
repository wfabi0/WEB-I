<?php

require_once '../proteger.php';
require_once '../conexao.php';

$nome = $_SESSION['funcionario_nome'];
$vendas = buscaTodasVendas();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas - Lanchonete Ota's</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
    <link rel="stylesheet" href="../assets/css/crud.css">
</head>
<body>
    <header>
        <div class="header-content">
            <a href="../painel.php" style="text-decoration: none; color: inherit;"><h1>🍔 Lanchonete Ota's</h1></a>
            <nav>
                <span>👤 <?= htmlspecialchars($nome) ?></span>
                <a href="../sair.php">🚪 Sair</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="../painel.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px;">⬅️ Voltar</a>
                <h2>🛒 Vendas</h2>
            </div>
            <a href="criar_venda.php" class="btn-novo">➕ Nova Venda</a>
        </div>

        <?php if (empty($vendas)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">🛒</div>
                <h3>Nenhuma Venda Registrada</h3>
                <p>Clique em "Nova Venda" para começar a registrar vendas.</p>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Funcionário</th>
                            <th>Total (R$)</th>
                            <th>Data da Venda</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['id']) ?></td>
                                <td><?= htmlspecialchars($v['funcionario_nome']) ?></td>
                                <td>R$ <?= number_format($v['total'], 2, ',', '.') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($v['data_venda'])) ?></td>
                                <td class="acoes">
                                    <a href="visualizar_venda.php?id=<?= $v['id'] ?>" class="btn-editar">👁️ Visualizar</a>
                                    <a href="deletar_venda.php?id=<?= $v['id'] ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar esta venda? O estoque será restaurado.')">🗑️ Deletar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>
    <script src="../assets/js/utils.js"></script>
</body>
</html>
