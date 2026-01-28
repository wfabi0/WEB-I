<?php

require_once '../proteger.php';
require_once '../conexao.php';

$nome = $_SESSION['funcionario_nome'];
$mensagem = '';
$tipo_mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_form = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($nome_form) || empty($email) || empty($senha)) {
        $mensagem = 'Todos os campos são obrigatórios!';
        $tipo_mensagem = 'error';
    } else {
        if (insereFuncionario($nome_form, $email, $senha)) {
            $mensagem = 'Funcionário criado com sucesso!';
            $tipo_mensagem = 'success';
        } else {
            $mensagem = 'Erro ao criar funcionário!';
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
    <title>Criar Funcionário - Lanchonete Ota's</title>
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
            <a href="funcionarios.php" class="btn-voltar" style="padding: 8px 16px; text-decoration: none; background: #FF9500; color: white; border-radius: 5px; font-size: 14px; display: inline-block;">⬅️ Voltar</a>
        </div>
        <div class="form-container">
            <h2>➕ Novo Funcionário</h2>

            <?php if ($mensagem): ?>
                <div class="alert-<?= $tipo_mensagem ?>">
                    <?= htmlspecialchars($mensagem) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" required autofocus>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="btn-salvar">💾 Salvar</button>
                    <a href="funcionarios.php" class="btn-cancelar" style="padding: 14px; text-align: center; text-decoration: none;">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 Lanchonete Ota's. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
