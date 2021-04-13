<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$user_id = $_SESSION['id'];

$st = $pdo->prepare("
SELECT f.* FROM fatura f
    INNER JOIN user_has_fatura uhf ON f.id = uhf.fatura_id
WHERE uhf.user_id = :user_id
");

$st->bindParam(':user_id', $user_id);
$st->execute();

$faturas = $st->fetchAll(PDO::FETCH_ASSOC);

foreach ($faturas as &$fatura) {
    $id = $fatura['id'];

    $st = $pdo->prepare("
        SELECT i.id, i.descricao,
               (i.valor / i.parcelas) as valor,
               CONCAT(fhi.parcela, '/', i.parcelas) as parcela,
               fhi.data as data_compra
        FROM fatura_has_item fhi
            INNER JOIN item i ON fhi.item_id = i.id
        WHERE fhi.fatura_id = :id
        ORDER BY data DESC
    ");

    $st->bindParam(':id', $id);
    $st->execute();

    $itens = $st->fetchAll(PDO::FETCH_ASSOC);
    $fatura['itens'] = $itens;
}

Utils::json($faturas);
