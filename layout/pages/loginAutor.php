<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Login</title>
</head>
<body>
  
    <main>
         
        <div class="containerLogin">
            <div class="logoLogin">LOGO</div>
            <div class="logoLogin">Área do autor</div>
            <div class="formLogin">
                <form class="boxFormLogin" method="POST">
                    <div class="bloco_email">
                        <label for="email">E-mail</label>
                        <input type="text" name="nm_email" class="nm_email" placeholder="Insira seu e-mail" required>
                    </div>

                    <div class="bloco_senha">
                        <label for="senha">Senha</label>
                        <input type="password" name="nm_senha" class="nm_senha" placeholder="Insira sua senha" required>
                    </div>

                    <div class="bloco_botao">
                        <input type="submit" value="Entrar">
                    </div>

                    <div class="bloco_resposta">
                    <?php
                    require_once "../../config/config.php";
                    session_start();

                    $classe_banco = new clsBanco();
                    $classe_banco->Conectar();
                        

                    $autor = new clsAutor($classe_banco);

                    if(isset($_POST['nm_email']) && isset($_POST['nm_senha'])) {
                        $autor->login($_POST['nm_email'], $_POST['nm_senha']);
                    }

                    ?>
                    </div>

                    <div class="bloco_criarConta">
                        <span>Ainda não possui uma conta? <a href="#">Cadastre agora</a></span>
                    </div>                   
                </form> 
            </div>
        </div>

    </main>
</body>
</html>

