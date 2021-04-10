<?php

require_once('../utils/session_util.php');
require_once('../utils/utils.php');
require_once('../controller/connect.php');

if($_SESSION['tipo'] == "U"){
    Utils::json(['message' => "Sem permissão de acesso!", 'error' => true]);
    http_response_code(403);
    exit();
}

global $pdo;

$status = "I";

$stmt = $pdo->prepare("SELECT u.*, p.*, e.* FROM user u 
    INNER JOIN pessoa p ON p.id = u.pessoa_id
    INNER JOIN endereco e ON e.id = p.endereco_id 
    WHERE u.status = 'I'");
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);