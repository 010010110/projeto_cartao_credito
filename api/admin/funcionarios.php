<?php
$pdo = Database::connection();

$stmt = $pdo->prepare("
SELECT u.tipo as tipo_usuario, u.email, u.renda_mensal, u.limite,
       p.nome, p.documento, p.telefone, p.tipo as tipo_pessoa,
       e.cep, e.numero
FROM user u
    INNER JOIN pessoa p ON u.pessoa_id = p.id
    INNER JOIN endereco e ON p.endereco_id = e.id
WHERE u.tipo = 'F'
");

$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);
