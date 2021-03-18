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
        <h1> Login:</h1>
        <nav>
            <a href="../../view/funcionario/login.php">login como funcionario</a>
            <a href="../../view/user/cad_user.php">solicitar cartao de credito</a>
            <a href="../../view/user/situacao.php">visualisar situacao pedido</a>
        </nav>
    </header>
    <main>
        <form method="POST" action="../../model/user/login.php">
            <input type="text" name="user" id="user" placeholder="User Name" autofocus required>
            <input type="password" name="password" id="password" placeholder="Password" required><br>
            <button>Login</button>
        </form>

    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>

</body>
</html>