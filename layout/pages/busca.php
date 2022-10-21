<?php require_once '../../config/config.php';
$classe_banco = new clsBanco();
$classe_banco->Conectar();

if(isset($_GET["busca"])) {
    $busca = $_GET["busca"];
}
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Busca</title>
</head>
<body>
<?php require_once $GLOBALS['raiz'] . '/layout/global/header.php'; ?>
    <main>
        <h1>Você buscou por: <?php echo $busca; ?></h1>

        <div class="containerLivros">
            <?php
            $livro = new clsLivro($classe_banco);
            echo $livro->selectLivroByBusca($busca);
            ?>
        </div>

    </main>
</body>
</html>