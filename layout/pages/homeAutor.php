<?php 
require_once "../../config/config.php";
require_once "../../config/session.php";
$autor = new clsAutor($classe_banco);
$autor->isLogged($cd_usuario);
$categoria = new clsCategoria($classe_banco);
$livro = new clsLivro($classe_banco);
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
    <link rel="stylesheet" href="../../assets/css/homeAutor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Login</title>
</head>
<body>
  
    <section class="geral">
        <?php echo $autor->menuLateral($cd_usuario)?>
        <div class="main">
            <div class="topo2">
                <div class="tituloPagina"><h1>Meus livros</h1></div>
                <div class="btnCadastro"><button id="btnCadastro1" onclick="muda('formulario')"><i class="fa-solid fa-circle-plus"></i>Cadastrar</button></div>
            </div>
            <form id="formulario" method="post" action="cadastro.php" enctype="multipart/form-data">
                <section class="base df dc">
                    <div class="df jst">
                        <div class="df dc width1">
                            <div class="container">
                                <div class="input-file-upload">
                                    <div class="upload-btn">
                                        <button class="btn">Selecionar imagem</button>
                                        <input type="file" name="upfile" id="upfile" onchange="readURL(this); ">
                                    </div>
                                    <img class="upload_img" id="file_upload">
                                </div>
                            </div>
                        </div>

                        <div class="df dc width2">
                            <label for="nm_categoria">Nome do livro</label>
                            <input type="text" name="nm_livro" id="nm_livro">
                            
                            <label for="ds_livro">Descrição do livro</label>
                            <input type="text" name="ds_livro" id="ds_livro">
                            
                            <label for="cd_categoria">Categoria do livro</label>
                            <?php echo $categoria->selectCategoria(); ?>

                            <label for="dt_lancamento">Data de lançamento</label>
                            <input type="date" name="dt_lancamento" id="dt_lancamento">
                        </div>
                    </div>
                    
                    <input type="submit" class="btn_confirmar" value="Confirmar">
                    <div id="resultado"></div>
                    

                </section>
            </form>

            <section class="containerLivros">
                <?php echo $livro->selectLivroByAutor($cd_usuario);?>
            </section>

        </div>
    </section>
    <script src="../../assets/js/home.js"></script>
    <!-- <script src="../../assets/js/formulario.js"></script> -->
</body>
</html>
