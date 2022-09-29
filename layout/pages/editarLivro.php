<?php 
require_once "../../config/config.php";
require_once "../../config/session.php";
$autor = new clsAutor($classe_banco);
$autor->isLogged($cd_usuario);
$categoria = new clsCategoria($classe_banco);
$livro = new clsLivro($classe_banco);

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $banco = $classe_banco->getBanco();
    $comando = "select * from livro ";
    $comando .= "where cd_livro = '".$id."'";
    $resultado = $banco->query($comando);
    $row = $resultado->fetch_assoc();
    $caminhoImg = "../../assets/images/" . $row["cd_img_livro"];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../../assets/css/menuLateral.css">
    <link rel="stylesheet" href="../../assets/css/editarLivro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Editar Livro</title>
</head>
<body>
  
    <section class="geral">
        <?php echo $autor->menuLateral($cd_usuario)?>
        <div class="main">
            <div class="topo2">
                <div class="tituloPagina"><h1><?php echo "Editar " .$row["nm_livro"]; ?></h1></div>
                
            </div>
            <form id="formulario" method="post" enctype="multipart/form-data">
                <section class="base df dc">
                    <div class="df jst">
                        <div class="df dc width1">
                            <div class="container">
                                <div class="input-file-upload">
                                    <div class="upload-btn">
                                        <button class="btn">Selecionar imagem</button>
                                        <input type="file" name="upfile" id="upfile" onchange="readURL(this); ">
                                    </div>
                                    <img class="upload_img" id="file_upload" src="<?php echo $caminhoImg; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="df dc width2">
                            <label for="nm_categoria">Nome do livro</label>
                            <input type="text" name="nm_livro" id="nm_livro" value="<?php echo $row["nm_livro"]; ?>">
                            
                            <label for="ds_livro">Descrição do livro</label>
                            <textarea name="ds_livro" id="ds_livro" cols="30" rows="10"><?php echo $row["ds_livro"]; ?></textarea>
                            
                            <label for="cd_categoria">Categoria do livro</label>
                            <?php echo $categoria->selectCategoria(); ?>

                            <label for="dt_lancamento">Data de lançamento</label>
                            <input type="date" name="dt_lancamento" id="dt_lancamento" value="<?php echo $row["dt_lancamento"]; ?>">
                        </div>
                    </div>
                    
                    <input type="submit" class="btn_confirmar" value="Confirmar">
                    <div id="resultado"></div>
                    

                </section>
            </form>

        </div>
    </section>
</body>
</html>
<script>
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#file_upload') 
              .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
  }
}
</script>

<?php 

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
        $livro->set_cd_categoria($nm_categoria);
        $livro->set_nm_livro($nm_livro);
        $livro->set_ds_livro($ds_livro);
        
		
	}
}

if (isset($_FILES['upfile'])) {
	if(!empty($_FILES["upfile"])) {
        if ($_FILES["upfile"]['name'] == $row["cd_img_livro"]) {
            $livro->set_cd_img_livro($row["cd_img_livro"]); 
        }
        else {
            $ext = strtolower(substr($_FILES['upfile']['name'], -4));
            $novo_nome = "img" . time() . $ext;
            $diretorio = "../../assets/images/";
            move_uploaded_file($_FILES['upfile'] ['tmp_name'],$diretorio.$novo_nome);
                
            $livro->set_cd_img_livro($novo_nome);
                
            if(isset($_POST["dt_lancamento"])) {				
                    
                if(!empty($_POST["dt_lancamento"])) {
                    $dt_lancamento = $_POST["dt_lancamento"];
                    $livro->set_dt_lancamento($dt_lancamento);
                    echo $livro->updateLivro($id);
                }
                else {
                    echo "preencha todos os campos";
                }
            }
        }
		
	}
}	


?>