<?php
require_once('../controller/connect.php');

global $pdo;

$email = $_POST['email'];
$senha = $_POST['senha'];

$st = $pdo->prepare("SELECT email FROM user WHERE email = :email");
$st->bindParam(':email', $email);
$st->execute();

if (!$st->rowCount()) {
    echo file_get_contents("./erros/erro_usuario.php");
    exit();
}

$st = $pdo->prepare("SELECT email FROM user WHERE email = :email AND senha = :senha");
$st->bindParam(':email', $email);
$st->bindParam(':senha', $senha);
$st->execute();

if (!$st->rowCount()) {
    echo file_get_contents("./erros/erro_senha.php");
    exit();
}

$st = $pdo->prepare("SELECT email from user WHERE email = :email AND status = 'A'");
$st->bindParam(':email', $email);
$st->execute();

if (!$st->rowCount()) {
    echo file_get_contents("./erros/erro_status.php");
    exit();
}

session_start();
$_SESSION['logado'] = true;
$_SESSION['user'] = $email;

header('Location: ../view/user/main.php');
