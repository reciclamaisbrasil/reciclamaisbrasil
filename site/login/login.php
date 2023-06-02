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
    $user = new User(null, null, $email, $senha);
    if($user->login($conexao)){
        switch($user->tipo_usu){
            case 1:
                echo "<p>É um usuário cpf</p>";
                echo "<pre>";
                print_r($_SESSION["User_cpf"]);
                echo "</pre>";
                break;
            case 2:
                echo "<p>É um usuário cnpj</p>";
                echo "<pre>";
                print_r($_SESSION["User_cnpj"]);
                echo "</pre>";
                break;
            case 3:
                echo "<p>É um usuário adm</p>";
                echo "<pre>";
                print_r($_SESSION["User_adm"]);
                echo "</pre>";
                break;
            default:
                echo "<p>Por algum motivo, o tipo de usuário bugou.<p>";
        }
    }else{
        echo "Deu ruim";
    }

?>