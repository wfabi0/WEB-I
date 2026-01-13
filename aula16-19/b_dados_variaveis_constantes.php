<?php
$a = 12;
$b = 12.698;
$c = false;
$d = true;
$e = 'Simples';
$f = "Duplas";
$g = "Duplas usando $e";
$h = [23, 25, 36];
$i = NULL;

echo '<pre>';

echo $a . ' tipo: ' . gettype($a) . '<br>';
echo $b . ' tipo: ' . gettype($b) . '<br>';

var_dump($c);
var_dump($d);
var_dump($e);
var_dump($f);
var_dump($g);
var_dump($h);
var_dump($i);

print_r($h);

// De linha
/* Bloco */
# asdasd 
# hjhjh

define('MAX', 10000);
var_dump(MAX);

var_dump($GLOBALS);
var_dump($_SERVER);
var_dump($_REQUEST);

var_dump(__DIR__);
var_dump(__FILE__);

echo '</pre>';