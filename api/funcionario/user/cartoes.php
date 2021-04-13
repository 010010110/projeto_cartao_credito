<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

if ($_SESSION['tipo'] == "C") {
    Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
    http_response_code(403);
    exit();
}

$stmt = $pdo->prepare("
SELECT c.id, c.tipo, c.status, c.numero, c.data_emissao, c.validade, c.categoria,
       p.nome as titular, p.documento, b.nome as bandeira, b.variante, b.imagem
FROM user_has_cartao uhc
    INNER JOIN pessoa p on uhc.pessoa_id = p.id
    INNER JOIN cartao c ON uhc.cartao_id = c.id
    INNER JOIN bandeira b on c.bandeira_id = b.id
ORDER BY FIELD(c.status, 'P', 'B', 'A', 'R', 'C')
");

$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);
