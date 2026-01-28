<?php

function conecta()
{
    $con = new PDO('mysql:host=localhost;port=3306;dbname=lanchonete_otas', 'root', 'root');
    return $con;
}

function buscaFuncionario($email)
{
    $con = conecta();
    $sql = "SELECT * FROM funcionarios WHERE email = '$email'";
    $res = $con->query($sql);
    $funcionario = $res->fetch(PDO::FETCH_ASSOC);
    return $funcionario;
}

function buscaTodosFuncionarios()
{
    $con = conecta();
    $sql = "SELECT * FROM funcionarios";
    $res = $con->query($sql);
    $lista = $res->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function insereFuncionario($nome, $email, $senha)
{
    $con = conecta();
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO funcionarios(nome, email, senha) VALUES('$nome', '$email', '$senha_hash')";
    $n = $con->exec($sql);
    return $n;
}

function deletaFuncionario($id)
{
    $con = conecta();
    $sql = "DELETE FROM funcionarios WHERE id = $id";
    $n = $con->exec($sql);
    return $n;
}

function editaFuncionario($id, $nome, $email)
{
    $con = conecta();
    $sql = "UPDATE funcionarios SET nome = '$nome', email = '$email' WHERE id = $id";
    $n = $con->exec($sql);
    return $n;
}

function buscaTodosProdutos()
{
    $con = conecta();
    $sql = "SELECT * FROM produtos";
    $res = $con->query($sql);
    $lista = $res->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function buscaProduto($id)
{
    $con = conecta();
    $sql = "SELECT * FROM produtos WHERE id = $id";
    $res = $con->query($sql);
    $produto = $res->fetch(PDO::FETCH_ASSOC);
    return $produto;
}

function insereProduto($nome, $descricao, $preco, $quantidade_estoque)
{
    $con = conecta();
    $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade_estoque) VALUES('$nome', '$descricao', $preco, $quantidade_estoque)";
    $n = $con->exec($sql);
    return $n;
}

function editaProduto($id, $nome, $descricao, $preco, $quantidade_estoque)
{
    $con = conecta();
    $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = $preco, quantidade_estoque = $quantidade_estoque WHERE id = $id";
    $n = $con->exec($sql);
    return $n;
}

function deletaProduto($id)
{
    $con = conecta();
    $sql = "DELETE FROM produtos WHERE id = $id";
    $n = $con->exec($sql);
    return $n;
}

function insereVenda($funcionario_id, $total)
{
    $con = conecta();
    $sql = "INSERT INTO vendas(funcionario_id, total) VALUES($funcionario_id, $total)";
    $con->exec($sql);
    return $con->lastInsertId();
}

function insereItemVenda($venda_id, $produto_id, $quantidade, $preco_unitario)
{
    $con = conecta();
    $subtotal = $quantidade * $preco_unitario;
    $sql = "INSERT INTO itens_venda(venda_id, produto_id, quantidade, preco_unitario, subtotal) VALUES($venda_id, $produto_id, $quantidade, $preco_unitario, $subtotal)";
    $con->exec($sql);
    
    $sql_update = "UPDATE produtos SET quantidade_estoque = quantidade_estoque - $quantidade WHERE id = $produto_id";
    $con->exec($sql_update);
}

function buscaTodasVendas()
{
    $con = conecta();
    $sql = "SELECT v.*, f.nome as funcionario_nome FROM vendas v JOIN funcionarios f ON v.funcionario_id = f.id";
    $res = $con->query($sql);
    $lista = $res->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}

function buscaVenda($id)
{
    $con = conecta();
    $sql = "SELECT * FROM vendas WHERE id = $id";
    $res = $con->query($sql);
    $venda = $res->fetch(PDO::FETCH_ASSOC);
    return $venda;
}

function buscaItensVenda($venda_id)
{
    $con = conecta();
    $sql = "SELECT i.*, p.nome FROM itens_venda i JOIN produtos p ON i.produto_id = p.id WHERE i.venda_id = $venda_id";
    $res = $con->query($sql);
    $itens = $res->fetchAll(PDO::FETCH_ASSOC);
    return $itens;
}

function deletaVenda($id)
{
    $con = conecta();
    $itens = buscaItensVenda($id);
    
    foreach ($itens as $item) {
        $sql_restore = "UPDATE produtos SET quantidade_estoque = quantidade_estoque + " . $item['quantidade'] . " WHERE id = " . $item['produto_id'];
        $con->exec($sql_restore);
    }
    
    $sql = "DELETE FROM itens_venda WHERE venda_id = $id";
    $con->exec($sql);
    
    $sql = "DELETE FROM vendas WHERE id = $id";
    $n = $con->exec($sql);
    return $n;
}
