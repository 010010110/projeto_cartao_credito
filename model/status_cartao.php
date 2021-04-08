<?php

require_once('../utils/utils.php');

session_start();
if (empty($_SESSION['login']) || $_SESSION['login'] == false) {
    header('Location: login.php');
}

require_once('../controller/connect.php');
global $pdo;

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

if (!array_key_exists('cartao_id', $payload)) {
    Utils::json(['message' => "Parâmetro 'cartao_id' não informado", 'error' => true]);

    exit();
}

if (!array_key_exists('status', $payload)) {
    Utils::json(['message' => "Parâmetro 'status' não informado", 'error' => true]);

    exit();
}

$email = $_SESSION['user'];
$cartao_id = $payload['cartao_id'];
$status = $payload['status'];

$stmt = $pdo->prepare('SELECT id FROM user WHERE email = :email');
$stmt->bindParam(':email', $email);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT * FROM user_has_cartao WHERE user_id = :user_id AND cartao_id = :cartao_id');
$stmt->bindParam(':user_id', $user['id']);
$stmt->bindParam(':cartao_id', $cartao_id);
$stmt->execute();

if (!$stmt->rowCount()) {
    Utils::json(['message' => "Cartão não encontrado!", 'error' => true]);

    exit();
}

$stmt = $pdo->prepare('UPDATE cartao SET status = :status WHERE id = :cartao_id');
$stmt->bindParam(':status', $status);
$stmt->bindParam(':cartao_id', $cartao_id);
$stmt->execute();

if ($status == "C") {
    Utils::json(['message' => 'Cartão cancelado com sucesso']);
} else if ($status == "B") {
    Utils::json(['message' => 'Cartão bloqueado com sucesso']);
}
