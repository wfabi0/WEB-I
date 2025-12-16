<?php
$a = 12;
$b = 12.695;
$c = false;
$d = true;
$e = 'Simples';
$f = 'Duplas';
$g = "Duplas com variáveis: $e";
$h = [1,2,3,4,5];
$i = NULL;

echo $a . ' tipo: ' . gettype($a) . '<br>';
echo $b . ' tipo: ' . gettype($b) . '<br>';
echo $c . ' tipo: ' . gettype($c) . '<br>';
echo $d . ' tipo: ' . gettype($d) . '<br>';
echo $e . ' tipo: ' . gettype($e) . '<br>';
echo $f . ' tipo: ' . gettype($f) . '<br>';
echo $g . ' tipo: ' . gettype($g) . '<br>';
echo 'Array tipo: ' . gettype($h) . '<br>';
echo 'NULL tipo: ' . gettype($i) . '<br>';

print_r($h);
print_r('<br>');

define('TAXA_DE_JUROS', 5.5);

var_dump($c);
var_dump($d);
var_dump($e);