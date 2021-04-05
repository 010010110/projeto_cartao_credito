<?php
session_start();
if (empty($_SESSION['logado']) || $_SESSION['logado'] == false) {
    header('Location: view/index.php');
} else header('Location: view/main.php');