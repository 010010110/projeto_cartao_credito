<?php
session_start();
if (empty($_SESSION['logado']) || $_SESSION['logado'] == false) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>login</title>
</head>
<body>
<header>
    <h1>Empresa</h1>
    <p>Olá <?= $_SESSION['user'] ?></p>
    <nav>
        <a href="../model/logout.php">Sair</a>
    </nav>
</header>
<main>
    <h2>Bem vindo!</h2>
</main>
<footer>
    Empresa de Cartão de crédito
</footer>

</body>
</html>