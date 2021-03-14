<?php
    require_once('../controller/connect.php');

    $cpf = $_POST['cpf'];
    
    $stmt = $pdo->prepare( 'SELECT situacao FROM user WHERE cpf = $cpf');
    //$stmt->bindValue( ':cpf', $cpf );
    // $situacao = $stmt->execute();

    // if (!$situacao){
    //     echo  "<script>alert('Cadastro Nao Encontrado!');
    //                 window.location='http://localhost/Code/login/view/login.php';
    //             </script>";
    // }else if($situacao == 1){
    //     echo  "<script>alert('Cadastro Aprovado! faca login para saber mais');
    //                 window.location='http://localhost/Code/login/view/login.php';
    //             </script>";
    // }else {
    //     echo  "<script>alert('Cadastro nao Aprovado!');
    //                 window.location='http://localhost/Code/login/view/login.php';
    //             </script>";
    // }
