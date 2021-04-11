<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/connect.php');

global $pdo;

require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

$st = $pdo->prepare("
SELECT * FROM bandeira
");

$st->execute();

$bandeiras = $st->fetchAll(PDO::FETCH_ASSOC);

Utils::json($bandeiras);