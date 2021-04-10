<?php
session_start();

if (empty($_SESSION['login']) || !$_SESSION['login']) {
    Utils::json(['message' => "Usuário não autenticado", 'error' => true]);
    http_response_code(403);

    exit();
}
