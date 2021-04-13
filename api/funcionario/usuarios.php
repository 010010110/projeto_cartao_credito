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
SELECT u.tipo as tipo_usuario, u.status, u.email, u.renda_mensal, u.limite,
       p.nome, p.documento, p.telefone, p.tipo as tipo_pessoa,
       e.cep, e.numero
FROM user u
    INNER JOIN pessoa p ON u.pessoa_id = p.id
    INNER JOIN endereco e ON p.endereco_id = e.id
WHERE u.tipo = 'C'
ORDER BY FIELD(u.status, 'I', 'A', 'R')
");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);
