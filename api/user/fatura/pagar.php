<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$user_id = $_SESSION['id'];

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['fatura_id', 'valor'], $payload);

$fatura_id = $payload['fatura_id'];
$valor = floatval($payload['valor']);

if ($valor <= 0) {
    Utils::json(['message' => "Valor a pagar inválido!", 'error' => true]);

    exit();
}

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
SELECT COALESCE(SUM(i.valor), 0) as total
FROM fatura_has_item fhi
    LEFT JOIN item i on fhi.item_id = i.id
WHERE fhi.fatura_id = :fatura_id
GROUP BY fhi.fatura_id
");

$st->bindParam(':fatura_id', $fatura_id);
$st->execute();

$total = $st->fetch(PDO::FETCH_ASSOC);
$total = floatval($total['total']);

$st = $pdo->prepare("
SELECT COALESCE(SUM(pf.valor), 0) as total
FROM fatura_has_item fhi
    LEFT JOIN pagamento_fatura pf on fhi.fatura_id = pf.fatura_id
WHERE fhi.fatura_id = :fatura_id
GROUP BY fhi.fatura_id
");

$st->bindParam(':fatura_id', $fatura_id);
$st->execute();

$total_pago = $st->fetch(PDO::FETCH_ASSOC);
$total_pago = floatval($total_pago['total']);

$total = $total - $total_pago;

if ($valor > $total) {
    Utils::json(['message' => "Valor a pagar inválido!", 'error' => true]);

    exit();
}

$st = $pdo->prepare("
INSERT INTO pagamento_fatura(data, valor, fatura_id)
VALUES(NOW(), :valor, :fatura_id)
");

$st->bindParam(':valor', $valor);
$st->bindParam(':fatura_id', $fatura_id);

$st->execute();

if ($total == $valor) {
    $st = $pdo->prepare("
        UPDATE fatura SET status = 'P'
        WHERE id = :fatura_id
    ");

    $st->bindParam(':fatura_id', $fatura_id);
    $st->execute();
}

Utils::json(['message' => 'Valor de R$ ' . $valor . ' pago para a fatura']);
