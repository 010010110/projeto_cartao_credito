<?php
require_once('../controller/connect.php');

global $pdo;

$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$documento = $_POST['documento'];
$telefone = $_POST['telefone'];
$renda_mensal = $_POST['renda_mensal'];

$cep = $_POST['cep'];
$numero = $_POST['numero'];

$email = $_POST['email'];
$senha = $_POST['senha'];

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
