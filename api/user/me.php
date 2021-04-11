<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

$email = $_SESSION['user'];

$st = $pdo->prepare("
SELECT u.*, p.*, e.* FROM user u
    INNER JOIN pessoa p ON u.pessoa_id = p.id
    INNER JOIN endereco e ON p.endereco_id = e.id
WHERE u.email = :email
");

$st->bindParam(':email', $email);

$st->execute();

$user = $st->fetch(PDO::FETCH_ASSOC);
Utils::json($user);