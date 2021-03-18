<?php

    session_start();
    if(empty($_SESSION['login_func']) || $_SESSION['login_func'] == false){
        header('Location: login.php');
    }

    function verifica_pedidos(){
        require_once('../../controller/connect.php');
        $pdo = Conexao::get();
        $situacao = "0";
        $result = $pdo->prepare('SELECT nome, telefone, cpf, renda_mensal, logradouro, bairro, cidade, uf, pais FROM user WHERE situacao=:situacao');
        $result->bindValue(':situacao', $situacao);
        $result->execute();
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Funcionario Pedidos de Cadastro</title>
</head>
<body>
    <header>
        <h1>Funcionario Pedidos de Cadastro:</h1>
        <p>welcome, <?= $_SESSION['func']?></p>
        <nav>
            <a href="../../model/funcionario/pedidos_cad.php">Pedidos de Cadastros</a>
            <a href="../../model/logout.php">Sair</a>
            <a href="#">#</a>
        </nav>
    </header>

    <table>
    <thead>
        <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th>Renda</th>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>UF</th>
        <th>Pais</th>
        </tr>
    </thead>
        <tbody>
        <?php 
            $result = verifica_pedidos();
            foreach ($result as $key => $value) {
                echo "<tr>";
                 foreach ($result[$key] as $cedula){
                    echo "<td>".$cedula."</td>";
                 };
                 echo "</tr>";
             }
        ?>
        </tbody>
    </table>

    <footer>
      Empresa de Cartao de credito
    </footer>

</body>
</html>