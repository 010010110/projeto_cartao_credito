<?php

    require_once('../../controller/connect.php');
    $pdo = Conexao::get();

    //pegras credenciais
    $func = $_POST['funcionario'] ?? '';
    $senha = $_POST['password'] ?? '';

    //inicialzia session
    session_start();
        
    $sth = $pdo->prepare('SELECT * FROM funcionario WHERE (func_login=:func AND func_senha=:senha)');
    $result = $sth->execute(array(':func' => $func, ':senha' => $senha));
    $result = $sth->fetch(PDO::FETCH_OBJ);
    //var_dump($result) ;
    //checar credenciais OK
    if($result == true){
        $_SESSION['login_func'] = true;
        $_SESSION['func'] = $_POST['funcionario'];
        header('Location: ../../view/funcionario/main.php');

    }else if($result == false){
        echo  "<script>alert('Login Invalido!');
                    location.href='../../view/funcionario/login.php';
               </script>";
    }

    //checar se user ja ta logado
    if(!empty($_SESSION['login_func']) && $_SESSION['login_func']){
        header('Location: ../../view/funcionario/main.php');
    }