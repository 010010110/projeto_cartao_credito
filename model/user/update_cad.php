<?php
    require_once('../../controller/connect.php');

    session_start();

    $nome = $_SESSION['user'];
    $tel = $_POST['tel'];
    $renda = $_POST['renda'];
    $senha = md5($_POST['password']);

    $stmt = $pdo->prepare('UPDATE user SET telefone=:tel, renda_mensal=:renda, senha=:senha WHERE nome = :nome');
    $stmt->execute(array(
    ':nome'   => $nome,
    ':tel' => $tel,
    ':renda' => $renda,
    'senha' => $senha
    ));
    echo    "<script>alert('Atualizacao Realizada!');
                location.href='../../view/user/main.php';
            </script>";