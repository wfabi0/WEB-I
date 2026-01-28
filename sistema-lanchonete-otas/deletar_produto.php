<?php

require_once './proteger.php';
require_once './conexao.php';

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    deletaProduto($id);
}

header('Location: produtos.php');
exit;
