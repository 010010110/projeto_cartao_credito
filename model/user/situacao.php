<?php
    require_once('../../controller/connect.php');
    $pdo = Conexao::get();

    $cpf = $_POST['cpf'];
    
    $sql = 'SELECT situacao FROM user WHERE cpf = :cpf LIMIT 1';
    
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':cpf' => $cpf));
    $result = $sth->fetch();

    if (!$result){
        echo    "<script>alert('Cadastro Nao Encontrado!');
                    location.href='../../view/user/login.php';
                </script>";
    }else if($result['situacao'] == 1){
        echo    "<script>alert('Cadastro Aprovado! faca login para saber mais');
                    location.href='../../view/user/login.php';
                </script>";
    }else {
        echo    "<script>alert('Cadastro nao Aprovado!');
                    location.href='../../view/user/login.php';
                </script>";
    }
