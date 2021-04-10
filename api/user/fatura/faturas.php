<?php
require_once('../../../utils/connect.php');

global $pdo;

require_once('../../../utils/session_util.php');
require_once('../../../utils/utils.php');
Utils::cors();

$user_id = $_SESSION['id'];

$st = $pdo->prepare("
SELECT fatura_id FROM user_has_fatura
WHERE user_id = :user_id
");

$st->bindParam(':user_id', $user_id);
$st->execute();

$faturas = $st->fetchAll(PDO::FETCH_ASSOC);
$faturas = array_map(fn($e) => $e['fatura_id'], $faturas);
$faturas = implode(',', $faturas);

$st = $pdo->prepare("
SELECT * FROM fatura
WHERE id IN ($faturas)
");

$st->execute();
$faturas = $st->fetchAll(PDO::FETCH_ASSOC);

foreach ($faturas as &$fatura) {
    $id = $fatura['id'];

    $st = $pdo->prepare("
        SELECT i.* FROM fatura_has_item fhi
            INNER JOIN item i ON fhi.item_id = i.id
        WHERE fhi.fatura_id = :id
    ");

    $st->bindParam(':id', $id);
    $st->execute();

    $itens = $st->fetchAll(PDO::FETCH_ASSOC);
    $fatura['itens'] = $itens;
}

Utils::json($faturas);
