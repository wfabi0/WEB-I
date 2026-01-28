<?php

require_once '../proteger.php';
require_once '../conexao.php';

$id = $_GET['id'] ?? '';

if (!empty($id)) {
    deletaVenda($id);
}

header('Location: vendas.php');
exit;
