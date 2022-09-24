<?php
require_once "../../config/config.php";
require_once "../../config/session.php";
$livro = new clsLivro($classe_banco);
if(isset($_GET["id"])) {
	$id = $_GET["id"];
}

echo $livro->deleteLivro($id);
?>