<?php
require_once __DIR__ . '/db.php';

function insereRegistroNoBanco($ra, $nome, $quantidade, $pagamento)
{
    $con = conecta();
    $sql = "REPLACE INTO alunos(ra,nome,quantidade,pagamento) VALUES('$ra', '$nome', $quantidade, '$pagamento')";
    return $con->exec($sql);
}

function buscaListaDoBanco()
{
    $con = conecta();
    $res = $con->query('SELECT * FROM alunos ORDER BY nome;');
    return $res->fetchAll(PDO::FETCH_ASSOC);
}

$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ra = $_POST['ra'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $quantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 0;
    $pagamento = $_POST['pagamento'] ?? '';
    insereRegistroNoBanco($ra, $nome, $quantidade, $pagamento);
    $success = 'Dados salvos.';
}

$rows = buscaListaDoBanco();
?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>UAN - Cadastro integrado</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Compra de Tickets - UAN (Integrado PHP)</h1>
            <?php if ($success): ?>
                <p class="success"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>
            <?php if ($errors): ?>
                <div class="error">
                    <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="">
                <label>RA (7 dígitos)
                    <input type="text" name="ra" maxlength="7" pattern="\d{7}" required value="<?= htmlspecialchars($_POST['ra'] ?? '') ?>">
                </label>
                <label>Nome Completo
                    <input type="text" name="nome" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                </label>
                <div class="row">
                    <div class="col">
                        <label>Quantidade de Tickets
                            <input type="number" name="quantidade" min="0" required value="<?= htmlspecialchars($_POST['quantidade'] ?? '1') ?>">
                        </label>
                    </div>
                    <div class="col">
                        <label>Forma de Pagamento
                            <select name="pagamento">
                                <option value="pix" <?= ((($_POST['pagamento'] ?? '') === 'pix') ? 'selected' : '') ?>>PIX</option>
                                <option value="dinheiro" <?= ((($_POST['pagamento'] ?? '') === 'dinheiro') ? 'selected' : '') ?>>Dinheiro</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="actions">
                    <button type="submit">Salvar</button>
                </div>
            </form>

            <h2>Lista de Alunos</h2>
            <table>
                <thead>
                    <tr>
                        <th>RA</th>
                        <th>Nome</th>
                        <th>Qtd</th>
                        <th>Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)): ?>
                        <tr>
                            <td colspan="4">Nenhum registro</td>
                        </tr>
                        <?php else: foreach ($rows as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['ra']) ?></td>
                                <td><?= htmlspecialchars($r['nome']) ?></td>
                                <td><?= htmlspecialchars($r['quantidade']) ?></td>
                                <td><?= htmlspecialchars($r['pagamento']) ?></td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>