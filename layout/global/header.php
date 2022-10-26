<header>
    <section class="barra">
        <div class="doubleContainer">
            <div class="containerLogo">LOGO</div>
            <div class="containerBusca">
                <form method="GET" action="../../layout/pages/busca.php">
                    <input type="text" id="busca" name="busca" placeholder="Busque por um título ou autor">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="containerPerfil"><i class="fa-solid fa-circle-user"></i><span>Olá, Luca</span></div>
    </section>

    <section class="barraCategoria">
        <ul>
            <li id="0"><a href="#">Todos</a></li>
            <?php  
            $categoria = new clsCategoria($classe_banco);
            echo $categoria->menuCategoria();
            ?>
        </ul>
    </section>

</header>
