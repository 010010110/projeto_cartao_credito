<?php
$pdo = Database::connection();

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['user_id', 'status'], $payload);

$stmt = $pdo->prepare('
UPDATE user u SET u.status = :status
WHERE u.id = :user_id
');

$stmt->bindParam(':status', $payload['status']);
$stmt->bindParam(':user_id', $payload['user_id']);

$stmt->execute();

Utils::json(['message' => 'Usuário atualizado com sucesso']);
