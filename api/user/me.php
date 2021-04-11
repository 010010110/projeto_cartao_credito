<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$email = $_SESSION['user'];

$st = $pdo->prepare("
SELECT u.tipo as tipo_usuario, u.email, u.renda_mensal, u.limite,
       p.nome, p.documento, p.telefone, p.tipo as tipo_pessoa,
       e.cep, e.numero
FROM user u
    INNER JOIN pessoa p ON u.pessoa_id = p.id
    INNER JOIN endereco e ON p.endereco_id = e.id
WHERE u.email = :email
");

$st->bindParam(':email', $email);

$st->execute();

$user = $st->fetch(PDO::FETCH_ASSOC);
Utils::json($user);