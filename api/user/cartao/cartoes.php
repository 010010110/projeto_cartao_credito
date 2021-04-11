<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$user_id = $_SESSION['id'];

$st = $pdo->prepare("
SELECT c.id, c.tipo, c.status, c.numero, c.data_emissao, c.validade, c.categoria,
       p.nome as titular, b.nome as bandeira, b.variante
FROM user_has_cartao uhc
    INNER JOIN pessoa p on uhc.pessoa_id = p.id
    INNER JOIN cartao c ON uhc.cartao_id = c.id
    INNER JOIN bandeira b on c.bandeira_id = b.id
WHERE uhc.user_id = :user_id
");

$st->bindParam(':user_id', $user_id);
$st->execute();

$cartoes = $st->fetchAll(PDO::FETCH_ASSOC);

Utils::json($cartoes);