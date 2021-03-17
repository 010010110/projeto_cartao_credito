<?php
    require_once('../controller/connect.php');

    $nome = $_POST['name'];
    $senha = md5($_POST['password']);
    $cpf = $_POST['cpf'];
    $tel = $_POST['tel'];
    $renda = $_POST['renda'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['num'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $pais = $_POST['pais'];
    $situacao = $_POST['situacao'];

    try{
        $stmt = $pdo->prepare('INSERT INTO user (nome, senha, cpf, telefone, renda_mensal, logradouro, numero, bairro, cidade, uf, pais, situacao)
                                 VALUES (:nome, :senha, :cpf, :tel, :renda, :logradouro, :numero, :bairro, :cidade, :uf, :pais, :situacao)');
        $stmt->bindParam( ':nome', $nome );
        $stmt->bindParam( ':senha', $senha );
        $stmt->bindParam( ':cpf', $cpf );
        $stmt->bindParam( ':tel', $tel );
        $stmt->bindParam( ':renda', $renda );
        $stmt->bindParam( ':logradouro', $logradouro );
        $stmt->bindParam( ':numero', $numero );
        $stmt->bindParam( ':bairro', $bairro );
        $stmt->bindParam( ':cidade', $cidade );
        $stmt->bindParam( ':uf', $uf );
        $stmt->bindParam( ':pais', $pais );
        $stmt->bindParam( ':situacao', $situacao );

        $result = $stmt->execute();
 
        if (!$result){
            var_dump( $stmt->errorInfo() );
            exit;
        }else{
            echo  "<script>alert('Solicitacao enviada! Aconpanhe a aituacao em localhost/login/view/situacao.php');
                            location.href='../view/login.php';
                     </script>";
        }

    }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }