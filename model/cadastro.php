<?php
require_once('../controller/connect.php');

global $pdo;

require_once('../utils/utils.php');
Utils::cors();

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

$st = $pdo->prepare("INSERT INTO endereco(cep, numero) VALUES(:cep, :numero);");
$st->bindParam(':cep', $cep);
$st->bindParam(':numero', $numero);

$st->execute();
$endereco_id = $pdo->lastInsertId('endereco');

$st = $pdo->prepare("INSERT INTO pessoa(nome, documento, telefone, tipo, endereco_id) VALUES(:nome, :documento, :telefone, :tipo, :endereco_id);");
$st->bindParam(':nome', $nome);
$st->bindParam(':documento', $documento);
$st->bindParam(':telefone', $telefone);
$st->bindParam(':tipo', $tipo);
$st->bindParam(':endereco_id', $endereco_id);

$st->execute();
$pessoa_id = $pdo->lastInsertId('pessoa');

$st = $pdo->prepare("INSERT INTO user(tipo, status, email, senha, renda_mensal, limite, pessoa_id) VALUES('U', 'I', :email, :senha, :renda_mensal, :limite, :pessoa_id)");
$st->bindParam(':email', $email);
$st->bindParam(':senha', $senha);
$st->bindParam(':renda_mensal', $renda_mensal);

$limite = $renda_mensal * 0.3;
$st->bindParam(':limite', $limite);
$st->bindParam(':pessoa_id', $pessoa_id);

$st->execute();

Utils::json(['message' => 'Cadastro realizado com sucesso']);
