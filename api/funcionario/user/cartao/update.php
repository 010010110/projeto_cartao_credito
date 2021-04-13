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

Utils::validar(['cartao_id', 'status'], $payload);

$status = $payload['status'];
$cartao_id = $payload['cartao_id'];

if ($status === 'A') {
    $stmt = $pdo->prepare("
        SELECT status FROM cartao
        where id = :cartao_id
    ");

    $stmt->bindParam(':cartao_id', $cartao_id);
    $stmt->execute();

    $cartao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cartao['status'] === 'P') {
        $cvv = mt_rand(0, 999);
        $cvv = str_pad($cvv, 3, '0', STR_PAD_LEFT);

        $numero = Utils::randomNum(4);

        $stmt = $pdo->prepare("
            UPDATE cartao c 
            SET c.numero = :numero, c.cvv = :cvv, c.data_emissao = NOW(), c.validade = DATE_ADD(NOW(), INTERVAL 6 YEAR)
            WHERE c.id = :cartao_id
        ");

        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':cvv', $cvv);

        $stmt->bindParam(':cartao_id', $cartao_id);
        $stmt->execute();
    }
}

$stmt = $pdo->prepare("
    UPDATE cartao c
    SET c.status = :status
    WHERE c.id = :cartao_id
");

$stmt->bindParam(':status', $status);
$stmt->bindParam(':cartao_id', $cartao_id);

$stmt->execute();


Utils::json(['message' => 'Cartão atualizado com sucesso!']);
