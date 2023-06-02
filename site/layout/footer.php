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

<script>
    // Seleciona o link e a janela modal
    var link = document.querySelector('.modal-link');
    var modal = document.querySelector('.modal');
    var overlay = document.querySelector('.overlay');

    // Adiciona um listener de evento para o link
    link.addEventListener('click', function (event) {
        event.preventDefault(); // previne o comportamento padrão do link (navegar para outra página)

        overlay.style.display = 'block'; // exibe a camada escura
        modal.style.display = 'block'; // exibe a janela modal
    });

    // Adiciona um listener de evento para a camada escura
    overlay.addEventListener('click', function () {
        overlay.style.display = 'none'; // oculta a camada escura
        modal.style.display = 'none'; // oculta a janela modal
    });
</script>

</html>