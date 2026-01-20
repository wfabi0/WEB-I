<?php
require_once __DIR__ . '/../db.php';

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

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'GET') {
    $rows = buscaListaDoBanco();
    echo json_encode(['data' => $rows]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) $input = $_POST;
$ra = $input['ra'] ?? '';
$nome = $input['nome'] ?? '';
$quantidade = isset($input['quantidade']) ? (int)$input['quantidade'] : 0;
$pagamento = $input['pagamento'] ?? '';
insereRegistroNoBanco($ra, $nome, $quantidade, $pagamento);
$rows = buscaListaDoBanco();
echo json_encode(['success' => true, 'data' => $rows]);
exit;
