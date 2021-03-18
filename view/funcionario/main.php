<?php
    session_start();
    if(empty($_SESSION['login_func']) || $_SESSION['login_func'] == false){
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
    <title>Funcionario Main</title>
</head>
<body>
    <header>
        <h1>Funcionario Main:</h1>
        <p>welcome, <?= $_SESSION['func']?></p>
        <nav>
            <a href="../../model/funcionario/pedidos_cad.php">Pedidos de Cadastros</a>
            <a href="../../model/logout.php">Sair</a>
            <a href="#">#</a>
        </nav>
    </header>
    <main>
        pagina main
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>

</body>
</html>