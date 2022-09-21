<?php 
$raiz = $_SERVER['DOCUMENT_ROOT'] . '/readnow_php';

function carregarClasses($nomeClasse)
{
	if (file_exists($GLOBALS['raiz'] . DIRECTORY_SEPARATOR . "/source/class/" . $nomeClasse . ".php"))
	{
		require_once($GLOBALS['raiz'] . DIRECTORY_SEPARATOR . "/source/class/" . $nomeClasse . ".php");
	}
}

spl_autoload_register("carregarClasses");

?>