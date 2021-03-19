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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>
</head>
<body class="vh-100">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Empresa</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>
            </div>
            <a class="btn btn-primary" href="../model/logout.php">Sair</a>
        </div>
    </nav>
</header>

<main class="container py-2">
    <h2>Bem vindo!</h2>

    <p>Olá <?= $_SESSION['user'] ?></p>
</main>

<footer class="position-absolute bottom-0 w-100 bg-light">
    <div class="container my-4">
        <div class="text-center">Empresa de Cartão de crédito</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>