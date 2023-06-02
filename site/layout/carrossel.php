<link rel="stylesheet" href="css/carrossel.css">
<div class="carrossel-container">
    <div class="content">
        <div class="navigation">
            <label class="bar" for="slide1"></label>
            <label class="bar" for="slide2"></label>
            <label class="bar" for="slide3"></label>
        </div>
        <div class="slides">
            <input class="input" type="radio" name="slide" id="slide1" checked>
            <input class="input" type="radio" name="slide" id="slide2">
            <input class="input" type="radio" name="slide" id="slide3">

            <div class="slide s1">
                <p>Encontre as empresas de reciclagem mais próxima de voce e ajude a salvar o planeta</p>
                <img src="img/Imagem1.jpg" alt="Imagem 1">
            </div>

            <div class="slide">
                <p>Realize seu cadastro na Recicla +Brasil para aproveitar todas as vantagens</p>
                <img src="img/Imagem2.jpg" alt="Imagem 2">
            </div>

            <div class="slide">
                <p>Ao reciclar você está contribuindo com a natureza</p>
                <img src="img/Imagem3.jpg" alt="Imagem 3">
            </div>
        </div>
    </div>
</div>

<script defer>
    let contador =1;

    setInterval(function(){
        document.getElementById('slide' + contador).checked = true;
        contador ++;

        if(contador >3){
            contador =1;
        }

    }, 3000)
</script>