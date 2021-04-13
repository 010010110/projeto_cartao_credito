<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

session_start();

if (empty($_SESSION['login']) || !$_SESSION['login']) {
    session_unset();
    session_abort();
    session_write_close();

    header_remove('Set-Cookie');
}

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

Utils::validar(['email', 'senha', 'tipo', 'documento', 'nome', 'telefone', 'renda', 'cep', 'numero'], $payload);

$email = $payload['email'];
$senha = $payload['senha'];

$tipo = $payload['tipo'];
$documento = $payload['documento'];

$nome = $payload['nome'];
$telefone = $payload['telefone'];
$renda_mensal = $payload['renda'];

$cep = $payload['cep'];
$numero = $payload['numero'];

$st = $pdo->prepare("
INSERT INTO endereco(cep, numero)
VALUES(:cep, :numero);
");

$st->bindParam(':cep', $cep);
$st->bindParam(':numero', $numero);

$st->execute();
$endereco_id = $pdo->lastInsertId('endereco');

$st = $pdo->prepare("
INSERT INTO pessoa(nome, documento, telefone, tipo, endereco_id)
VALUES(:nome, :documento, :telefone, :tipo, :endereco_id);
");

$st->bindParam(':nome', $nome);
$st->bindParam(':documento', $documento);
$st->bindParam(':telefone', $telefone);
$st->bindParam(':tipo', $tipo);
$st->bindParam(':endereco_id', $endereco_id);

$st->execute();
$pessoa_id = $pdo->lastInsertId('pessoa');

$tipo_usuario = 'C';

if (!empty($_SESSION['tipo'])) {
    if ($_SESSION['tipo'] == 'A') {
        $tipo_usuario = 'F';
    }
}

$st = $pdo->prepare("
INSERT INTO user(tipo, status, email, senha, renda_mensal, limite, pessoa_id)
VALUES(:tipo_usuario, 'I', :email, :senha, :renda_mensal, :limite, :pessoa_id)
");

$st->bindParam(':tipo_usuario', $tipo_usuario);

$st->bindParam(':email', $email);
$st->bindParam(':senha', $senha);
$st->bindParam(':renda_mensal', $renda_mensal);

$limite = $renda_mensal * 0.3;
$st->bindParam(':limite', $limite);
$st->bindParam(':pessoa_id', $pessoa_id);

$st->execute();

Utils::json(['message' => 'Cadastro realizado com sucesso']);
