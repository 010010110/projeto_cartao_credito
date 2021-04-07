<?php
session_start();
if (empty($_SESSION['login']) || $_SESSION['login'] == false) {
    header('Location: login.php');
}

require_once('../utils/utils.php');
require_once('../controller/connect.php');

global $pdo;

$status = "I";

$stmt = $pdo->prepare("SELECT u.*, p.*, e.* FROM user u 
    INNER JOIN pessoa p ON p.id = u.pessoa_id
    INNER JOIN endereco e ON e.id = p.endereco_id 
    WHERE u.status = 'I'");
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

Utils::json($results);