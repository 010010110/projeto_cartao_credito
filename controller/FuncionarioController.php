<?php

class FuncionarioController
{

    public function getUsuarios()
    {
        require 'api/funcionario/usuarios.php';
    }

    public function getCartoes()
    {
        require 'api/funcionario/user/cartoes.php';
    }

    public function updateUser()
    {
        require 'api/funcionario/user/update.php';
    }

    public function updateCartao()
    {
        require 'api/funcionario/user/cartao/update.php';
    }

}