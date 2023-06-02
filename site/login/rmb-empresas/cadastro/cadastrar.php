<?php
    include_once("../../../../classes/conexao.php");
    include_once("../../../../classes/user.php");
    session_start();

    
    $nome =  mysqli_real_escape_string($conexao,trim( $_POST['nome']));
    $email = mysqli_real_escape_string($conexao,trim( $_POST['email'])); 
    $cnpj = mysqli_real_escape_string($conexao,trim( $_POST['cnpj'])); 
    $senha = mysqli_real_escape_string($conexao, md5(trim($_POST['senha'])));
    $usu_cpf = new User(null, $nome, $email, $senha, 1, $cnpj);
    if($usu_cpf->cadastro($conexao, 2)){
        $endereco = new Endereco(null, $usu_cpf->id, null, null, null, null, null, null, null);
        $usu_cpf->atribui_endereco($endereco);
        header('Location: ../perfil/index.php');
    }else{
        echo "Deu ruim";
    }

?>