<?php
require_once('../../utils/connect.php');

global $pdo;

require_once('../../utils/session_util.php');
require_once('../../utils/utils.php');
Utils::cors();

$data = file_get_contents('php://input');
$payload = json_decode($data, TRUE);

$email = $_SESSION['user'];

$cep = $payload['cep'];
$numero = $payload['numero'];

$telefone = $payload['telefone'];
$renda_mensal = $payload['renda_mensal'];
$limite = $renda_mensal * 0.3;

$stmt = $pdo->prepare('
UPDATE user u
    INNER JOIN pessoa p ON u.pessoa_id = p.id
    INNER JOIN endereco e on p.endereco_id = e.id
SET u.renda_mensal = :renda_mensal, u.limite = :limite, p.telefone = :telefone, e.cep = :cep, e.numero = :numero
    WHERE u.email = :email
');

$stmt->bindParam(':numero', $numero);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':renda_mensal', $renda_mensal);
$stmt->bindParam(':limite', $limite);

$stmt->execute();

Utils::json(['message' => 'Cadastro atualizado com sucesso']);
