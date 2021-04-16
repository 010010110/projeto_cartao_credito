<?php
$pdo = Database::connection();

$user_id = $_SESSION['id'];

$st = $pdo->prepare("
SELECT f.*, COALESCE(SUM(pf.valor), 0) as valor_pago
FROM fatura f
    INNER JOIN user_has_fatura uhf ON f.id = uhf.fatura_id
    LEFT JOIN pagamento_fatura pf on f.id = pf.fatura_id
WHERE uhf.user_id = :user_id
GROUP BY f.id 
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
