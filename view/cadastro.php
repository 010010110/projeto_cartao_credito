<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <title>Cadastro</title>
</head>
<body class="vh-100">

<div class="p-2 h-100">
    <div class="row align-items-center justify-content-center h-100">
        <div class="col-6 m-auto p-0 card text-center">
            <div class="card-header">
                Cadastro
            </div>
            <div class="card-body">
                <form method="POST" action="../model/cadastro.php">
                    <h5 class="card-title">Criar uma conta</h5>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <label for="senha" class="col-sm-2 col-form-label">Senha:</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control" name="senha" id="senha">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nome" id="nome">
                        </div>
                        <label for="telefone" class="col-sm-2 col-form-label">Telefone:</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="telefone" id="telefone">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tipo" class="col-sm-2 col-form-label">Tipo:</label>
                        <div class="col-sm-2">
                            <select class="form-select" name="tipo" id="tipo">
                                <option value="F">Física</option>
                                <option value="J">Jurídica</option>
                            </select>
                        </div>
                        <label for="documento" class="col-sm-2 col-form-label">Documento:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="documento" id="documento">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cep" class="col-sm-2 col-form-label">CEP:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="cep" id="cep">
                        </div>
                        <label for="numero" class="col-sm-2 col-form-label">Número:</label>
                        <div class="col-sm-1">
                            <input type="number" min="0" step="1" class="form-control" name="numero" id="numero">
                        </div>
                        <label for="renda_mensal" class="col-sm-2 col-form-label">Renda mensal:</label>
                        <div class="col-sm-3">
                            <input type="number" min="0" step="0.01" class="form-control" name="renda_mensal" id="renda_mensal">
                        </div>
                    </div>
                    <input type="submit" class="w-25 btn btn-primary" value="Cadastrar">
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