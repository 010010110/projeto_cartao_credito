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
    <title>Update Cadastro</title>
</head>
<body>
    <header>
        <h1>Atualizar Cadastro:</h1>
        <p>Atualize seu Cadastro</p>
    </header>
    <main>
        <form method="POST" action="../model/update_cad.php">
           <fieldset>
                <input type="tel" name="tel" id="tel" placeholder="Tel (ex: (xx) xxxx-xxxx))" pattern = "\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}">
                <input type="number" name="renda" id="renda" placeholder="Renda Mensal">
                <input type="password" name="password" id="password" placeholder="Password (min 8)" minlength="8"><br>
            </fieldset>
            <button>Atualizar</button>
        </form>
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>
</body>
</html>