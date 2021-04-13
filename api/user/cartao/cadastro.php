<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/session_util.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');

$user_id = $_SESSION['id'];

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['tipo', 'senha', 'categoria', 'bandeira'], $payload);

if (array_key_exists('pessoa', $payload) && !is_null($payload['pessoa'])) {
    Utils::validar(['nome', 'documento', 'telefone', 'tipo', 'endereco'], $payload['pessoa']);
    Utils::validar(['cep', 'numero'], $payload['pessoa']['endereco']);

    $pessoa = $payload['pessoa'];
    $endereco = $payload['pessoa']['endereco'];

    $st = $pdo->prepare("
    INSERT INTO endereco(cep, numero)
    VALUES (:cep, :numero)
    ");

    $st->bindParam(':cep', $endereco['cep']);
    $st->bindParam(':numero', $endereco['numero']);

    $st->execute();
    $endereco_id = $pdo->lastInsertId('endereco');

    $st = $pdo->prepare("
    INSERT INTO pessoa(nome, documento, telefone, tipo, endereco_id)
    VALUES (:nome, :documento, :telefone, :tipo, :endereco_id)
    ");

    $st->bindParam(':nome', $pessoa['nome']);
    $st->bindParam(':documento', $pessoa['documento']);
    $st->bindParam(':telefone', $pessoa['telefone']);
    $st->bindParam(':tipo', $pessoa['tipo']);
    $st->bindParam(':endereco_id', $endereco_id);

    $st->execute();
    $pessoa_id = $pdo->lastInsertId('pessoa');
} else {
    $st = $pdo->prepare("
    SELECT pessoa_id FROM user
    WHERE id = :user_id
    ");

    $st->bindParam(':user_id', $user_id);
    $st->execute();

    $user = $st->fetch(PDO::FETCH_ASSOC);
    $pessoa_id = $user['pessoa_id'];
}

$st = $pdo->prepare("
INSERT INTO cartao(tipo, status, senha, categoria, bandeira_id)
VALUES (:tipo, 'P', :senha, :categoria, :bandeira)
");

$st->bindParam(':tipo', $payload['tipo']);
$st->bindParam(':senha', $payload['senha']);
$st->bindParam(':categoria', $payload['categoria']);
$st->bindParam(':bandeira', $payload['bandeira']);

$st->execute();
$cartao_id = $pdo->lastInsertId('cartao');

$st = $pdo->prepare("
INSERT INTO user_has_cartao(user_id, cartao_id, pessoa_id)
VALUES (:user_id, :cartao_id, :pessoa_id)
");

$st->bindParam(':user_id', $user_id);
$st->bindParam(':cartao_id', $cartao_id);
$st->bindParam(':pessoa_id', $pessoa_id);

$st->execute();

Utils::json(['message' => 'Cartão requisitado com sucesso!']);
