<?php
require_once('../utils/session_util.php');
require_once('../controller/connect.php');

global $pdo;

$email = $_SESSION['user'];
$cep = $_POST['cep'];
$numero = $_POST['numero'];

$telefone = $_POST['telefone'];
$renda_mensal = $_POST['renda_mensal'];
$limite = $renda_mensal * 0.3;

$stmt = $pdo->prepare('UPDATE e, u, p SET e.cep = :cep, e.numero = :numero, p.telefone = :telefone, u.renda_mensal = :renda_mensal, u.limite = :limite
        FROM user u
        INNER JOIN pessoa p ON p.id = u.pessoa_id
        INNER JOIN endereco e ON e.id = p.endereco_id 
        WHERE u.email = :email');
$stmt->bindParam(':numero', $numero);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':renda_mensal', $renda_mensal);
$stmt->bindParam(':limite', $limite);

$stmt->execute();
