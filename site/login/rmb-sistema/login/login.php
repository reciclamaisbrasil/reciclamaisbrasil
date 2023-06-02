<?php
    include_once("../../classes/conexao.php");
    include_once("../../classes/user.php");
    session_start();

    #Verifica se os campos foram preenchidos
    if(empty($_POST['email']) || empty($_POST['senha'])){
        header('Location: index.php');
        exit();
    }
    
    $email = mysqli_real_escape_string($conexao,trim( $_POST['email'])); 
    $senha = mysqli_real_escape_string($conexao, md5(trim($_POST['senha'])));
    $usu_cpf = new User(null, null, $email, $senha);
    if($usu_cpf->login(3, $conexao)){
        header('Location: ../perfil/index.php');
    }else{
        echo "Deu ruim";
    }

?>