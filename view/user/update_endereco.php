<?php
    session_start();
    if(empty($_SESSION['logado']) || $_SESSION['logado'] == false){
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
    <title>Update Endereco</title>
</head>
<body>
    <header>
        <h1>Atualizar Endereco:</h1>
        <p>Atualize seu Endereco</p>
    </header>
    <main>
        <form method="POST" action="../../model/user/update_endereco.php">
            <fieldset>
                <input type="text" name="logradouro" id="logradouro" placeholder="Rua">
                <input type="number" name="num" id="num" placeholder="Numero">
                <input type="text" name="bairro" id="bairro" placeholder="Bairro">
                <input type="text" name="cidade" id="cidade" placeholder="Cidade">
                <input type="text" name="uf" id="uf" placeholder="UF" maxlength="2">
                <input type="text" name="pais" id="pais" placeholder="Pais">
            </fieldset>
            <button>Atualizar</button>
        </form>
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>
</body>