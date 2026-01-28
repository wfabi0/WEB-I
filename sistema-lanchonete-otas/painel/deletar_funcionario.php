<?php

require_once '../proteger.php';
require_once '../conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: funcionarios.php');
    exit;
}

if (deletaFuncionario($id)) {
    header('Location: funcionarios.php');
    exit;
} else {
    header('Location: funcionarios.php');
    exit;
}
