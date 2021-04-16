<?php

class UserController
{

    public function login()
    {
        require 'api/login.php';
    }

    public function logout()
    {
        require 'api/logout.php';
    }

    public function cadastro()
    {
        require 'api/cadastro.php';
    }

    public function getData()
    {
        require 'api/user/me.php';
    }

    public function update()
    {
        require 'api/user/update.php';
    }

    public function getFaturas()
    {
        require 'api/user/fatura/faturas.php';
    }

    public function pagarFatura()
    {
        require 'api/user/fatura/pagar.php';
    }

    public function simularCompra()
    {
        require 'api/user/fatura/simular.php';
    }

    public function getCartoes()
    {
        require 'api/user/cartao/cartoes.php';
    }

    public function getBandeiras()
    {
        require 'api/user/cartao/bandeiras.php';
    }

    public function cadastrarCartao()
    {
        require 'api/user/cartao/cadastro.php';
    }

    public function updateCartao()
    {
        require 'api/user/cartao/update.php';
    }

}