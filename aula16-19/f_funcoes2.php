<?php
function funcao01() {
    echo 'Funcao 01.<br>';
}

function funcao02($a, $b) {
    $s = $a + $b;
    return $s;
}

$funcao03 = function () {
    echo 'Função 03.<br>';
};

$funcao04 = fn($x) => 2 * $x;