<?php
session_start();
if (empty($_SESSION['login']) || $_SESSION['login'] == false) {
    header('Location: view/index.php');
} else header('Location: view/main.php');