<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Entrar</title>
</head>
<body class="vh-100">
<div class="p-2 h-100">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-4 m-auto p-0 card text-center">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <form method="POST" action="../model/login.php">
                    <h5 class="card-title">Entrar na sua conta</h5>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Usuário:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="senha" class="col-sm-2 col-form-label">Senha:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="senha" id="senha">
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary w-25" value="Entrar">
                    <a href="cadastro.php" class="btn btn-primary w-25">Cadastrar</a>
                </form>
            </div>
            <div class="card-footer text-muted">
                Empresa de Cartão de Crédito
            </div>
        </div>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>