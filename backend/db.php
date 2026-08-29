<?php

$host = getenv('DB_HOST') ?: 'mysql-service';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: 'Senha123';
$database = getenv('DB_NAME') ?: 'meubanco';

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_errno) {
    throw new RuntimeException('Falha ao conectar ao banco de dados.');
}

$mysqli->set_charset('utf8mb4');
