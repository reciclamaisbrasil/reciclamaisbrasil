<?php
    include_once("../../../../classes/conexao.php");
    include_once("../../../../classes/user.php");
    session_start();

    
    $nome =  mysqli_real_escape_string($conexao,trim( $_POST['nome']));
    $email = mysqli_real_escape_string($conexao,trim( $_POST['email'])); 
    $senha = mysqli_real_escape_string($conexao, md5(trim($_POST['senha'])));
    $usu_cpf = new User(null, $nome, $email, $senha);
    if($usu_cpf->cadastro($conexao, 3)){
        header('Location: ../perfil/index.php');
    }else{
        echo "Deu ruim";
    }

?>