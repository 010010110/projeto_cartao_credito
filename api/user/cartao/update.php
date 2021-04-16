<?php
$pdo = Database::connection();

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['cartao_id', 'status'], $payload);

$user_id = $_SESSION['id'];

$cartao_id = $payload['cartao_id'];
$status = $payload['status'];

$stmt = $pdo->prepare('
SELECT * FROM user_has_cartao 
WHERE user_id = :user_id AND cartao_id = :cartao_id
');

$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':cartao_id', $cartao_id);
$stmt->execute();

if (!$stmt->rowCount()) {
    Utils::json(['message' => "Cartão não encontrado!", 'error' => true]);

    exit();
}

$stmt = $pdo->prepare('
UPDATE cartao SET status = :status
WHERE id = :cartao_id
');

$stmt->bindParam(':status', $status);
$stmt->bindParam(':cartao_id', $cartao_id);
$stmt->execute();

if ($status == "C") {
    Utils::json(['message' => 'Cartão cancelado com sucesso']);
} else if ($status == "B") {
    Utils::json(['message' => 'Cartão bloqueado com sucesso']);
}
