<?php

require_once './proteger.php';
require_once './conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ?rota=funcionarios');
    exit;
}

if (deletaFuncionario($id)) {
    header('Location: ?rota=funcionarios');
    exit;
} else {
    header('Location: ?rota=funcionarios');
    exit;
}
