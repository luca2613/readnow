<?php 
require_once $GLOBALS['raiz'] . '/config/config.php';
session_start();
$classe_banco = new clsBanco();
$classe_banco->Conectar();
$cd_usuario =  $_SESSION["cd_autor"];

?>

