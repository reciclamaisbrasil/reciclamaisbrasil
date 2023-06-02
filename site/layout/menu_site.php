<header class="main_header">
    <div class="main_header_content">
        <a href="#" class="logo">
            <img src="img/logo.svg" alt="Bem vindo a Recicla +Brasil" title="Bem vindo a Recicla +Brasil"></a>

        <nav class="main_header_content_menu">
            <ul>
                <li><a href="">Faça Parte</a></li>
                <li><a href="#contato">Sobre</a></li>
                <?php 
                    # verifica se existe sessão de usuario e se ele é administrador.
                    # se não for o primeiro caso, verifica se a sessao existe.
                    # por ultimo adiciona somente o link para o login se a sessão não existir. 
                    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['perfil'] == 'ADM' )  {
                        echo "<li><a href='usuario_admin.php'>Admin</a></li>";
                        echo "<li><a href='logout.php'>Sair</a></li>";
                    } else if(isset($_SESSION['usuario'])) {
                        echo "<li><a href='logout.php'>Sair</a></li>";
                    } else {
                        echo "<li><a href='site/login/login.php' >Login</a>";                
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>