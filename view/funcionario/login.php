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
        <h1> Login Funcionario:</h1>
    </header>
    <main>
        <form method="POST" action="../../model/funcionario/login.php">
            <input type="text" name="funcionario" id="funcionario" placeholder="Funcionario User" autofocus required>
            <input type="password" name="password" id="password" placeholder="Password" required><br>
            <button>Login</button>
        </form>        
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>

</body>
</html>