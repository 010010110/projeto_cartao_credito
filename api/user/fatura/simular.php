<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$user_id = $_SESSION['id'];

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['fatura_id', 'valor', 'descricao', 'parcelas'], $payload);

$fatura_id = $payload['fatura_id'];

$st = $pdo->prepare("
SELECT fatura_id FROM user_has_fatura
WHERE user_id = :user_id AND fatura_id = :fatura_id
");

$st->bindParam(':user_id', $user_id);
$st->bindParam(':fatura_id', $fatura_id);
$st->execute();

if (!$st->rowCount()) {
    Utils::json(['message' => "Fatura não encontrada!", 'error' => true]);

    exit();
}

$st = $pdo->prepare("
INSERT INTO item(valor, descricao, parcelas)
VALUES (:valor, :descricao, :parcelas)
");

$st->bindParam(':valor', $payload['valor']);
$st->bindParam(':descricao', $payload['descricao']);
$st->bindParam(':parcelas', $payload['parcelas']);
$st->execute();

$item_id = $pdo->lastInsertId('item');

$st = $pdo->prepare("
INSERT INTO fatura_has_item(fatura_id, item_id, parcela)
VALUES (:fatura_id, :item_id, 1)
");

$st->bindParam(':fatura_id', $fatura_id);
$st->bindParam(':item_id', $item_id);
$st->execute();

Utils::json(['message' => 'Item inserido na fatura com sucesso!']);
