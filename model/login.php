<?php


    //pegras credenciais
    $user = $_POST['user'] ?? '';
    $password = $_POST['password'] ?? '';
    $err  = false;

    //inicialzia session
    session_start(); // a12h4ihi4h63h hash

    //checar credenciais OK
    if($user == 'admin' && $password == '123456'){
        $_SESSION['logado'] = true;
        $_SESSION['user'] = $user;

        header('Location: ../view/main.php');
    }else if(!empty($_POST)){
        $err = true;
    }

    //checar se user ja ta logado

    if(!empty($_SESSION['logado']) && $_SESSION['logado']){
        header('Location: ../view/main.php');
    }