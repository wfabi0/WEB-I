<?php

require_once '../proteger.php';
require_once '../conexao.php';

$nome = $_SESSION['funcionario_nome'];
$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_form = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $quantidade_estoque = $_POST['quantidade_estoque'] ?? '';

    if (empty($nome_form) || empty($descricao) || empty($preco) || empty($quantidade_estoque)) {
        $mensagem = 'Todos os campos são obrigatórios!';
        $tipo_mensagem = 'error';
    } else {
        if (insereProduto($nome_form, $descricao, $preco, $quantidade_estoque)) {
            $mensagem = 'Produto criado com sucesso!';
            $tipo_mensagem = 'success';
            $_POST = [];
        } else {
            $mensagem = 'Erro ao criar produto!';
            $tipo_mensagem = 'error';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Produto - Lanchonete Ota's</title>
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
        <div style="margin-bottom: 20px;">
            <a href="produtos.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px; display: inline-block;">⬅️ Voltar</a>
        </div>
        <div class="form-container">
            <h2>Criar Novo Produto</h2>

            <?php if (!empty($mensagem)): ?>
                <div class="alert-<?= $tipo_mensagem ?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($_POST['descricao'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$)</label>
                    <input type="number" id="preco" name="preco" step="0.01" value="<?= htmlspecialchars($_POST['preco'] ?? '') ?>" required>
                </div>

                <div class="form-group">
                    <label for="quantidade_estoque">Quantidade em Estoque</label>
                    <input type="number" id="quantidade_estoque" name="quantidade_estoque" value="<?= htmlspecialchars($_POST['quantidade_estoque'] ?? '') ?>" required>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-salvar">💾 Salvar</button>
                    <a href="produtos.php" class="btn-cancelar" style="padding: 14px; text-align: center; text-decoration: none;">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
