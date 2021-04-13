<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

if ($_SESSION['tipo'] !== "F") {
    Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
    http_response_code(403);

    exit();
}

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
