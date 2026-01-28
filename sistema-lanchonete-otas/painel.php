<?php

require_once './proteger.php';
require_once './conexao.php';

$nome = $_SESSION['funcionario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Lanchonete Ota's</title>
    <link rel="stylesheet" href="assets/css/painel.css">
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
        <div class="welcome-box">
            <h2>Gerenciamento da Lanchonete Ota's</h2>
            <p>Escolha uma opção abaixo para começar a gerenciar o sistema da lanchonete.</p>
        </div>

        <h3 class="menu-title">📋 Menu Principal</h3>
        
        <div class="menu-box">
            <a href="painel/funcionarios.php" class="menu-item">
                <div class="icon">👥</div>
                <h2>Funcionários</h2>
                <p>Gerenciar usuários do sistema</p>
            </a>

            <a href="painel/produtos.php" class="menu-item">
                <div class="icon">📦</div>
                <h2>Produtos</h2>
                <p>Gerenciar cardápio e estoque</p>
            </a>

            <a href="painel/vendas.php" class="menu-item">
                <div class="icon">💰</div>
                <h2>Vendas</h2>
                <p>Registrar e acompanhar vendas</p>
            </a>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
