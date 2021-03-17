<?php

    require_once('../controller/connect.php');

    //pegras credenciais
    $user = $_POST['user'] ?? '';
    $senha = $_POST['password'] ?? '';
    $situacao = 1;
    $err  = false;

    //inicialzia session
    session_start();
        
    $sth = $pdo->prepare('SELECT nome, senha, situacao FROM user WHERE (nome=:user AND senha=:senha AND situacao=:situacao)');
    $result = $sth->execute(array(':user' => $user, ':senha' => $senha, ':situacao' => $situacao));
    $result = $sth->fetch(PDO::FETCH_OBJ);
    //var_dump($result) ;
    //checar credenciais OK
    if($result == true){
        $_SESSION['logado'] = true;
        $_SESSION['user'] = $_POST['user'];
        header('Location: ../view/main.php');

    }else if($result == false){
        $err = true;
        echo  "<script>alert('Login Invalido!');
                            location.href='../view/login.php';
                     </script>";
    }

    //checar se user ja ta logado

    if(!empty($_SESSION['logado']) && $_SESSION['logado']){
        header('Location: ../view/main.php');
    }