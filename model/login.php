<?php
require_once('../utils/utils.php');
require_once('../controller/connect.php');

global $pdo;

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

if (!array_key_exists('email', $payload)) {
    Utils::json(['message' => "Parâmetro 'email' não informado", 'error' => true]);

    exit();
}

if (!array_key_exists('senha', $payload)) {
    Utils::json(['message' => "Parâmetro 'senha' não informado", 'error' => true]);

    exit();
}

$email = $payload['email'];
$senha = $payload['senha'];

$st = $pdo->prepare("SELECT email FROM user WHERE email = :email AND senha = :senha");
$st->bindParam(':email', $email);
$st->bindParam(':senha', $senha);
$st->execute();

if (!$st->rowCount()) {
    Utils::json(['message' => 'Usuário ou senha inválidos', 'error' => true]);

    exit();
}

$st = $pdo->prepare("SELECT email, tipo from user WHERE email = :email AND status = 'A'");
$st->bindParam(':email', $email);
$st->execute();

if (!$st->rowCount()) {
    Utils::json(['message' => 'Sua conta ainda não foi ativada', 'error' => true]);

    exit();
}

$user = $st->fetch(PDO::FETCH_ASSOC);

session_start();
$_SESSION['login'] = true;
$_SESSION['user'] = $user['email'];
$_SESSION['tipo'] = $user['tipo'];

Utils::json(['message' => 'Usuário autenticado com sucesso']);
