<?php

require_once '../proteger.php';
require_once '../conexao.php';

$nome = $_SESSION['funcionario_nome'];
$produtos = buscaTodosProdutos();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Lanchonete Ota's</title>
    <link rel="stylesheet" href="../assets/css/painel.css">
    <link rel="stylesheet" href="../assets/css/crud.css">
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
        <div class="page-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="../painel.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px;">⬅️ Voltar</a>
                <h2>📦 Produtos</h2>
            </div>
            <a href="criar_produto.php" class="btn-novo">➕ Novo Produto</a>
        </div>

        <?php if (empty($produtos)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📦</div>
                <h3>Nenhum Produto Cadastrado</h3>
                <p>Clique em "Novo Produto" para começar a adicionar produtos ao catálogo.</p>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Data de Criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produtos as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['id']) ?></td>
                                <td><?= htmlspecialchars($p['nome']) ?></td>
                                <td><?= htmlspecialchars($p['descricao']) ?></td>
                                <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                                <td><?= htmlspecialchars($p['quantidade_estoque']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($p['data_criacao'])) ?></td>
                                <td class="acoes">
                                    <a href="editar_produto.php?id=<?= $p['id'] ?>" class="btn-editar">✏️ Editar</a>
                                    <a href="deletar_produto.php?id=<?= $p['id'] ?>" class="btn-deletar" onclick="return confirm('Tem certeza que deseja deletar este produto?')">🗑️ Deletar</a>
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