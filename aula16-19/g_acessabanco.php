<?php
function conecta() {
    $con = new PDO('mysql:host=localhost;port=3306;dbname=dbtest2', 'root', 'root');
    return $con;
}

function insereRegistroNoBanco($nome, $idade) {
    $con = conecta();
    $n = $con->exec("insert into pessoas(nome, idade) values('$nome', $idade);");
    return $n;
}

function buscaListaDoBanco() {
    $con = conecta();
    $res = $con->query('select * from pessoas;');
    $lista = $res->fetchAll(PDO::FETCH_ASSOC);
    return $lista;
}