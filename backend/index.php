<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode(['status' => 'ok', 'service' => 'dio-backend']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['message' => 'Método não permitido.']);
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$comentario = trim($_POST['comentario'] ?? '');

if ($nome === '' || $email === '' || $comentario === '') {
    http_response_code(422);
    echo json_encode(['message' => 'Preencha todos os campos.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['message' => 'Informe um e-mail válido.']);
    exit;
}

try {
    require __DIR__ . '/db.php';

    $stmt = $mysqli->prepare(
        'INSERT INTO mensagens (nome, email, comentario) VALUES (?, ?, ?)'
    );
    $stmt->bind_param('sss', $nome, $email, $comentario);
    $stmt->execute();

    http_response_code(201);
    echo json_encode(['message' => 'Mensagem cadastrada com sucesso.']);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['message' => 'Erro interno ao salvar a mensagem.']);
}
