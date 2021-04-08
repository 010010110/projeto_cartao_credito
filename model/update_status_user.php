<?php
require_once('../utils/utils.php');
require_once('../controller/connect.php');
require_once('../utils/session_util.php');

if($_SESSION['tipo'] == "U"){
    Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
    http_response_code(403);
    exit();
}

global $pdo;

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

if (!array_key_exists('user_id', $payload)) {
    Utils::json(['message' => "Parâmetro 'user_id' não informado", 'error' => true]);

    exit();
}

if (!array_key_exists('status', $payload)) {
    Utils::json(['message' => "Parâmetro 'status' não informado", 'error' => true]);

    exit();
}

$user_id = $payload['user_id'];
$status = $payload['status'];

$stmt = $pdo->prepare('UPDATE user u SET u.status = :status
        WHERE u.id = :user_id');
$stmt->bindParam(':status', $status);

$stmt->execute();


