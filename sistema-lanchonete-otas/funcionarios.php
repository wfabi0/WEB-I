<?php

require_once './proteger.php';
require_once './conexao.php';

$nome = $_SESSION['funcionario_nome'];
$funcionarios = buscaTodosFuncionarios();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários - Lanchonete Ota's</title>
    <link rel="stylesheet" href="assets/css/painel.css">
    <link rel="stylesheet" href="assets/css/crud.css">
</head>
<body>
    <header>
        <div class="header-content">
            <a href="painel.php" style="text-decoration: none; color: inherit;"><h1>🍔 Lanchonete Ota's</h1></a>
            <nav>
                <span>👤 <?= htmlspecialchars($nome) ?></span>
                <a href="sair.php">🚪 Sair</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="page-header">
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="painel.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px;">⬅️ Voltar</a>
                <h2>👥 Funcionários</h2>
            </div>
            <a href="criar_funcionario.php" class="btn-novo">➕ Novo Funcionário</a>
        </div>

        <?php if (empty($funcionarios)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                <h3>Nenhum funcionário cadastrado</h3>
                <p>Comece criando um novo funcionário</p>
                <a href="?rota=funcionarios&acao=criar" class="btn-novo">➕ Adicionar Funcionário</a>
            </div>
        <?php else: ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Data de Criação</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionarios as $funcionario): ?>
                            <tr>
                                <td>#<?= $funcionario['id'] ?></td>
                                <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                                <td><?= htmlspecialchars($funcionario['email']) ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($funcionario['data_criacao'])) ?></td>
                                <td>
                                    <div class="acoes">
                                        <a href="?rota=funcionarios&acao=editar&id=<?= $funcionario['id'] ?>" class="btn-editar">✏️ Editar</a>
                                        <a href="deletar_funcionario.php?id=<?= $funcionario['id'] ?>" class="btn-deletar" onclick="return confirm('Tem certeza?')">🗑️ Deletar</a>
                                    </div>
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
</body>
</html>
