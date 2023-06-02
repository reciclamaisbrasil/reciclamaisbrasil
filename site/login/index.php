<!DOCTYPE html>
<html lang="pt-br">

<?php
# para trabalhar com sessões sempre iniciamos com session_start.
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="../../css/boot.css" rel="stylesheet">
    <link href="../../css/lista.css" rel="stylesheet">
    <link href="../../css/fonticon.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/login.css" rel="stylesheet">

    <script type="text/javascript" src="js/modal.js"></script>
    <link href="css/modal.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novoform.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login Recicla +Brasil</title>
</head>

<body>
    <header class="main_header">
        <div class="main_header_content">
            <a href="#" class="logo">
                <img src="../../img/logo.svg" alt="Bem vindo a Recicla +Brasil" title="Bem vindo a Recicla +Brasil"></a>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="../../">Home</a></li>
                    <li><a href="">Faça Parte</a></li>
                    <li><a href="#contato">Sobre</a></li>
                    <?php
                    # verifica se existe sessão de usuario e se ele é administrador.
                    # se não for o primeiro caso, verifica se a sessao existe.
                    # por ultimo adiciona somente o link para o login se a sessão não existir. 
                    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['perfil'] == 'ADM') {
                        echo "<li><a href='usuario_admin.php'>Admin</a></li>";
                        echo "<li><a href='logout.php'>Sair</a></li>";
                    } else if (isset($_SESSION['usuario'])) {
                        echo "<li><a href='logout.php'>Sair</a></li>";
                    } else {
                        echo "<li><a href='site/login/index.php' class='modal-link'>Login</a>";
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <?php
        # verifca se existe uma mensagem de erro enviada via GET.
        # se sim, exibe a mensagem enviada no cabeçalho.
        if (isset($_GET['error'])) { ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Usuários',
                    text: '<?= $_GET['error'] ?>',
                })
            </script>
        <?php } ?>

        <section class="main-section">
            <div class="main-login">
                <div class="left-login">
                    <h1>Faça login<br>E entre para o nosso time</h1>
                    <img src="../../img/recycling-animate.svg" class="left-login-image" alt="Reciclagem animação">
                </div>
                <div class="right-login">
                    <div class="card-login">
                        <h1>LOGIN</h1>
                        <form action="login.php" method="post">
                            <div id="text-field">
                                <label for="email" placeholder="Digite o e-mail">E-mail: </label>
                                <input type="email" name="email" placeholder="Digite o e-mail" required>
                            </div>
                            <div id="text-field">
                                <label for="password">Senha: </label>
                                <input type="password" name="senha" placeholder="Digite a senha" required>
                            </div>
                            <button type="submit" class="btn-login">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!--INCIIO DOBRA RODAPE-->

    <footer class="main_footer_rights">
        <section class="main_footer">
            <article class="main_footer_our_pages">
                <header>
                    <h2>Saiba mais</h2>
                </header>
                <ul>
                    <li><a href="#">Seja nosso parceiro</a></li>
                    <li><a href="#">Sobre nós</a></li>
                </ul>
            </article>

            <article class="main_footer_links">
                <header>
                    <h2>Serviços</h2>
                </header>
                <ul>
                    <li><a href="#">Ache a empresa mais próxima</a></li>
                    <li><a href="#">Ver todos os serviços</a></li>
                </ul>
            </article>

            <article class="main_footer_about">
                <header>
                    <h2>Atendimento ao cliente</h2>
                </header>
                <ul>
                    <li><a href="#">Fale conosco</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </article>
        </section>
    </footer>
    <section class="copyright">
        <span>&#169;</span> Recicla +Brasil - Todos os direitos reservados.</p>
    </section>
    <!--FIM DOBRA RODAPE-->

</body>

</html>