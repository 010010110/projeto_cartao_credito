<?php 
session_start();
if (empty($_SESSION['login']) || !$_SESSION['login']) {
    header('Location: login.php');
}else{
    header('Location: ');
}