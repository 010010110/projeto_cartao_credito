<?php
    require_once('../../controller/connect.php');
    $pdo = Conexao::get();

    session_start();

    $nome = $_SESSION['user'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['num'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $pais = $_POST['pais'];

    $stmt = $pdo->prepare('UPDATE user SET logradouro=:logradouro, numero=:numero, bairro=:bairro, cidade=:cidade, uf=:uf, pais=:pais WHERE nome = :nome');
    $stmt->execute(array(
    ':nome'   => $nome,
    ':logradouro' => $logradouro,
    ':numero' => $numero,
    ':bairro' => $bairro,
    ':cidade' => $cidade,
    ':uf' => $uf,
    ':pais' => $pais
    ));
    echo    "<script>alert('Atualizacao Realizada!');
                location.href='../../view/user/main.php';
            </script>";