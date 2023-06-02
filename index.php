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
    <link href="css/boot.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/fonticon.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link href="css/lista.css" rel="stylesheet">
    <link href="css/carrossel.css" rel="stylesheet">

    <script type="text/javascript" src="js/modal.js"></script>
    <link href="css/modal.css" rel="stylesheet">
    <link rel="stylesheet" href="css/novoform.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Recicla +Brasil</title>
</head>

<body>
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
            if(isset($_GET['error'])) { ?>
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Usuários',
            text: '<?=$_GET['error'] ?>',
        })
        </script>
        <?php } ?>

        <!--INICIO CARROSSEL-->
        <div class="body">
            <div class="content">
                <div class="slides">
                    <input class="input" type="radio" name="slide" id="slide1" checked>
                    <input class="input" type="radio" name="slide" id="slide2">
                    <input class="input" type="radio" name="slide" id="slide3">

                    <div class="slide s1">
                        <p>Encontre as empresas de reciclagem mais próxima de você</p>
                        <p>e ajude a salvar o planeta</p>
                        <p><a href="#" class="carrossel-btn">Cadastre-se</a></p>
                        <img src="img/Imagem1.jpg" alt="Imagem 1">
                    </div>

                    <div class="slide">
                        <p>Realize seu cadastro na Recicla +Brasil para aproveitar todas as vantagens</p>
                        <p><a href="#" class="carrossel-btn">Mais sobre nós</a></p>
                        <img src="img/Imagem2.jpg" alt="Imagem 2">
                    </div>

                    <div class="slide">
                        <p>Ao reciclar você está contribuindo com a natureza</p>
                        <p><a href="#" class="carrossel-btn">Conheça nossos serviços</a></p>
                        <img src="img/Imagem3.jpg" alt="Imagem 3">
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation">
            <label class="bar" for="slide1"></label>
            <label class="bar" for="slide2"></label>
            <label class="bar" for="slide3"></label>
        </div>

        <script src="js/carrossel.js"></script>
        <!--FIM CARROSSEL-->

        <!--INICIO SESSAO DE ARTIGOS-->
        <section class="main_blog">
            <header class="main_blog_header">
                <h1>Mais sobre reciclagem</h1>
            </header>

            <article>
                <table>
                    <tr>
                        <td>
                            <a href="#">
                                <img src="img/truck.jpg" width="200" alt="Imagem post" title="Imagem Post">
                            </a>
                        </td>
                        <td>
                            <p>Você sabia que apenas 4% do lixo gerado é reciclado?</p>
                            <h2>Levantamento realizado em 2021 aponta que caso houvesse um bom trabalho na separação
                                de
                                lixo, os números poderiam chegar a 40%.</h2>
                        </td>
                    </tr>
                </table>
            </article>

            <article>
                <table>
                    <tr>
                        <td>
                            <p>Pilhas e baterias são uns dos principais agentes que poluem o planeta</p>
                            <h2>Pilhas e baterias são descartadas em lixões ao ar livre contaminando o solo e quando
                                são
                                descartadas em aterros sanitários acabam contaminando lençõis freáticos e cursos
                                d'água.
                            </h2>
                        </td>
                        <td>
                            <a href="#">
                                <img src="img/battery.jpg" width="200" alt="Imagem post" title="Imagem Post">
                            </a>
                        </td>
                    </tr>
                </table>
            </article>

            <article>
                <table>
                    <tr>
                        <td>
                            <a href="#">
                                <img src="img/recycle.jpg" width="200" alt="Imagem post" title="Imagem Post">
                            </a>
                        </td>
                        <td>
                            <p>Você sabia que existem diversas empresas de reciclagem próximas a você?</p>
                            <h2>Além de ajudar a natureza, você pode estar ganhando dinheiro por reciclar materiais
                                recicláveis.</h2>
                        </td>
                    </tr>
                </table>
            </article>
        </section>
        <!--FIM SESSAO DE ARTIGOS-->

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