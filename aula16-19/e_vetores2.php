<?php
$v1 = [10 => 12, 36, 365];
$v2 = [
    'nome' => 'Maria', 
    'sobrenome' => 'Silva', 
    'idade' => 45
];

echo '<pre>';
var_dump($v1);
var_dump($v2);

echo 'O nome da pessoa é: ' . $v2['nome'] . '<br>';

echo '<br>';
echo 'Todos os dados com foreach <br>';
foreach ($v2 as $valor) {
    echo $valor . '<br>';
}

echo '<br>';
echo 'Todos os dados e índices com foreach <br>';
foreach ($v2 as $chave => $valor) {
    echo $chave . ': ' . $valor . '<br>';
    //echo "$chave: $valor<br>";
}

echo '</pre>';