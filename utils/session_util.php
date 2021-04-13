<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/utils/utils.php');
Utils::cors();

session_start();

if (empty($_SESSION['login']) || !$_SESSION['login']) {
    Utils::json(['message' => "Usuário não autenticado", 'error' => true]);
    http_response_code(403);

    session_unset();
    session_abort();
    session_write_close();

    header_remove('Set-Cookie');

    exit();
}
