<?php 
require_once "../../config/config.php";
require_once "../../config/session.php";
$autor = new clsAutor($classe_banco);
$autor->isLogged($cd_usuario);
?>