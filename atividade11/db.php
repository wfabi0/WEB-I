<?php
function conecta()
{
    $DB_HOST = getenv('DB_HOST') ?: 'localhost';
    $DB_NAME = getenv('DB_NAME') ?: 'uan';
    $DB_USER = getenv('DB_USER') ?: 'root';
    $DB_PASS = getenv('DB_PASS') ?: 'root';

    $uri = "mysql:host=$DB_HOST;port=3306;dbname=$DB_NAME";
    return new PDO($uri, $DB_USER, $DB_PASS);
}
