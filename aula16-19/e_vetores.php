<?php
$v1 = [12, 36, 365];
$v2 = array(23,36,14,0);

$v3 = [true, 'Teste', 452, 15.36];

$v4[] = 'Augusto';
$v4[] = 10;
$v4[] = 20;
$v4[] = 40.69;

echo '<pre>';
echo 'V1 com for <br>';
for ($i=0; $i < count($v1); $i++) { 
    echo $v1[$i] . '<br>';
}
echo '<br><br>';

var_dump($v2);
var_dump($v3);
var_dump($v4);

echo '</pre>';