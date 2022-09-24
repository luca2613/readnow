<?php
require_once "../../config/config.php";
require_once "../../config/session.php";

$livro = new clsLivro($classe_banco);

if(isset($_GET["id"])) {
	$id = $_GET["id"];
}
if(isset($_POST["nm_livro"])) {
	if(!empty($_POST["nm_livro"])) {
		$nm_livro = $_POST["nm_livro"];
		
	}
}

if(isset($_POST["ds_livro"])) {
	if(!empty($_POST["ds_livro"])) {
		$ds_livro = $_POST["ds_livro"];	
		
	}
}
	
if(isset($_POST["nm_categoria"])) {			
	if(!empty($_POST["nm_categoria"])) {
		$nm_categoria = $_POST["nm_categoria"];
		
	}
}
		
$livro->set_cd_livro("DEFAULT");

if (isset($_FILES['upfile'])) {
	if(!empty($_FILES["upfile"])) {
		$ext = strtolower(substr($_FILES['upfile']['name'], -4));
		$novo_nome = "img" . time() . $ext;
		$diretorio = "../../assets/images/";
		move_uploaded_file($_FILES['upfile'] ['tmp_name'],$diretorio.$novo_nome);
		$livro->set_cd_autor($cd_usuario);
        $livro->set_cd_categoria($nm_categoria);
        $livro->set_nm_livro($nm_livro);
        $livro->set_ds_livro($ds_livro);
        $livro->set_cd_img_livro($novo_nome);

        
		
		
		if(isset($_POST["dt_lancamento"])) {				
			
			if(!empty($_POST["dt_lancamento"])) {
				$dt_lancamento = $_POST["dt_lancamento"];
				$livro->set_dt_lancamento($dt_lancamento);
				
				if($id == "")  {
                    echo $livro->insertLivro();
				}	
				
			}
			else {
				echo "preencha todos os campos";
			}
		}
	}
}	


?>