<?php

require_once './conexao.php';

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header('Location: login.php?erro=1');
    exit;
}

$funcionario = buscaFuncionario($email);

if ($funcionario && password_verify($senha, $funcionario['senha'])) {
    session_start();
    $_SESSION['funcionario_id'] = $funcionario['id'];
    $_SESSION['funcionario_nome'] = $funcionario['nome'];
    
    header('Location: painel.php');
    exit;
} else {
    header('Location: login.php?erro=1');
    exit;
}
