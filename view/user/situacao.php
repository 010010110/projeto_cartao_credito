<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>situacao</title>
</head>
<body>
    <header> 
    <h3>Verificar Situacao de Pedido de Cartao</h3>
    </header>
    <main>
        <form method="POST" action="../../model/user/situacao.php">
            <fildset>
                <input type="text" name="cpf" id="cpf" placeholder="CPF (ex: nnn.nnn.nnn-nn)" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" size="40" required><br>
                <button>Verificar Situacao</button>
            </fildset>
        </form>
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>
</body>
</html>