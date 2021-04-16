<?php
$pdo = Database::connection();

$st = $pdo->prepare("
SELECT * FROM bandeira
");

$st->execute();

$bandeiras = $st->fetchAll(PDO::FETCH_ASSOC);

Utils::json($bandeiras);
