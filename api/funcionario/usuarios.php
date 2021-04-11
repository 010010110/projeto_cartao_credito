<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

if ($_SESSION['tipo'] == "U") {
    Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
    http_response_code(403);
    exit();
}

$stmt = $pdo->prepare("
SELECT u.*, p.*, e.* FROM user u 
    INNER JOIN pessoa p ON p.id = u.pessoa_id
    INNER JOIN endereco e ON e.id = p.endereco_id 
    WHERE u.tipo = 'U' AND u.status = 'I'
");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);
