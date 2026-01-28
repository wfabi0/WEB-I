<?php
if (isset($_GET['erro'])) {
    $erro = true;
} else {
    $erro = false;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lanchonete Ota's</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <div class="logo">🍔</div>
                <h1>Lanchonete Ota's</h1>
                <p class="login-subtitle">Painel de Controle</p>
            </div>

            <?php if ($erro): ?>
                <div class="alert">❌ Email ou senha inválidos!</div>
            <?php endif; ?>

            <form method="POST" action="verificar_login.php">
                <div class="form-group">
                    <label for="email">📧 Email</label>
                    <input type="email" id="email" name="email" placeholder="seu@email.com" required autofocus>
                </div>

                <div class="form-group">
                    <label for="senha">🔒 Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn">🚀 Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>
