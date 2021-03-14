<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Cadastro</title>
</head>
<body>
    <header>
        <h1>Cadastre-se</h1>
        <p>Solicite seu Cartao de credito<br>Preencha os dados e envia uma solicitacao</p>
    </header>
    <main>
        <form method="POST" action="../model/cad_user.php">
           <fieldset>
                <input type="text" name="name" id="name" placeholder="Nome" autofocus required>
                <input type="text" name="cpf" id="cpf" placeholder="CPF (ex: nnn.nnn.nnn-nn)" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" required>
                <input type="tel" name="tel" id="tel" placeholder="Tel (ex: (xx) xxxx-xxxx))" pattern = "\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4}" required>
                <input type="number" name="renda" id="renda" placeholder="Renda Mensal"  required>
                <input type="password" name="password" id="password" placeholder="Password (min 8)" minlength="8" required><br>
            </fieldset>
            <fieldset>
                <input type="text" name="logradouro" id="logradouro" placeholder="Rua" required>
                <input type="number" name="num" id="num" placeholder="Numero" required>
                <input type="text" name="bairro" id="bairro" placeholder="Bairro" required>
                <input type="text" name="cidade" id="cidade" placeholder="Cidade" required>
                <input type="text" name="uf" id="uf" placeholder="UF" maxlength="2" required>
                <input type="text" name="pais" id="pais" placeholder="Pais" required>
            </fieldset>
            <button>Solicite seu cartao</button>
        </form>
    </main>
    <footer>
      Empresa de Cartao de credito
    </footer>
</body>
</html>