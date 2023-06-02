<?php
    include_once("endereco.php");

    class User{
        public $id;
        public $nome;
        public $email;
        public $senha;
        public $tipo_usu;
        public $status_conta_usu_cnpj = null;
        public $cnpj_usu_cnpj = null;
        public $endereco = null;
        
        public function __construct($id, $nome, $email, $senha, $status_conta_usu_cnpj=null, $cnpj_usu_cnpj=null){
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->status_conta_usu_cnpj = $status_conta_usu_cnpj;
            $this->cnpj_usu_cnpj = $cnpj_usu_cnpj;
        }

        # Autentica o login automaticamente, 
        public function login($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $tipo_usu = $this->def_tipo_usu($conexao);
            $email = $this->email;
            $senha = $this->senha;

            switch($tipo_usu){
                case 1:
                    $query = "SELECT * FROM `usu_cpf` WHERE email_usu_cpf = '$email' and senha_usu_cpf = '$senha'";
                    break;
                case 2:
                    $query = "SELECT * FROM `usu_cnpj` WHERE email_usu_cnpj = '$email' and senha_usu_cnpj = '$senha'";
                    break;
                case 3:
                    $query = "SELECT * FROM `adm` WHERE email_adm = '$email' and senha_adm = '$senha'";
                    break;
                default:
                    return false;
            }

            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result); 
            $usu_bd = mysqli_fetch_assoc($result);

            if($row == 1){

                switch($tipo_usu){
                    case 1:
                        $this->__construct($usu_bd["id_usu_cpf"], $usu_bd["nome_usu_cpf"], $usu_bd["email_usu_cpf"], $usu_bd["senha_usu_cpf"], null, null);
                        $_SESSION["User_cpf"] = $this;
                        break;
                    case 2:
                        $this->__construct($usu_bd["id_usu_cnpj"], $usu_bd["nome_usu_cnpj"], $usu_bd["email_usu_cnpj"], $usu_bd["senha_usu_cnpj"], $usu_bd["status_conta_usu_cnpj"], $usu_bd["cnpj_usu_cnpj"]);
                        $_SESSION["User_cnpj"] = $this;
                        break;
                    case 3:
                        $this->__construct($usu_bd["id_adm"], $usu_bd["nome_adm"], $usu_bd["email_adm"], $usu_bd["senha_adm"], null, null);
                        $_SESSION["User_adm"] = $this;
                        break;
                    default:
                        return false;
                }
                return true;
            }else{
                return false;
            }
        }
        # Autentica o cadastro automaticamente, 
        public function cadastro($conexao, $tipo_usu=null){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm

            $email = $this->email;
            $nome = $this->nome;
            $senha = $this->senha;
            if($tipo_usu == null){
                $tipo_usu = $this->def_tipo_usu($conexao);
            }

            if($this->verifica_email_ja_cadastrado($conexao)){

                switch($tipo_usu){
                    case 1:
                        $query = "INSERT INTO `usu_cpf`(`nome_usu_cpf`, `email_usu_cpf`, `senha_usu_cpf`) VALUES ('$nome','$email','$senha')";
                        break;
                    case 2:
                        $cnpj = $this->cnpj_usu_cnpj;
                        $query = "INSERT INTO `usu_cnpj`(`nome_usu_cnpj`, `email_usu_cnpj`, `senha_usu_cnpj`, `cnpj_usu_cnpj`) VALUES ('$nome','$email','$senha','$cnpj')";
                        break;
                    case 3:
                        $query = "INSERT INTO `adm`(`nome_adm`, `email_adm`, `senha_adm`) VALUES ('$nome','$email','$senha')";
                        break;
                    default:
                        return false;
                }

                if($conexao->query($query) === TRUE){
                    if($this->login($conexao)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

        public function logout($location="login/index.php"){
            session_destroy();
            $location = "Location: ".$location;
            header($location);
            exit();
        }

        # Verifica se o email já foi cadastrado no banco
        public function verifica_email_ja_cadastrado($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            echo "<p>Cheguei em verificar o tipo de email</p>";
            $email = $this->email;

            $query1 = "select count(*) as total from usu_cpf where email_usu_cpf = '$email'";
            $query2 = "select count(*) as total from usu_cnpj where email_usu_cnpj = '$email'";
            $query3 = "select count(*) as total from adm where email_adm = '$email'";
        

            $result = mysqli_query($conexao, $query1);
            $row1 = mysqli_fetch_assoc($result); 
            $result = mysqli_query($conexao, $query2);
            $row2 = mysqli_fetch_assoc($result);
            $result = mysqli_query($conexao, $query3);
            $row3 = mysqli_fetch_assoc($result);

            if($row1['total'] >= 1 or $row2['total'] >= 1 or $row3['total'] >= 1){
                echo "<p>Este email parece já ter sido cadastrado</p>";
                return false;
            }else{
                return true;
            }
        }

        # Faz o update do objeto no banco
        public function updade($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $id = $this->id;
            $nome = $this->nome;
            $email = $this->email;
            $senha= $this->senha;
            $tipo_usu = $this->tipo_usu;

            switch($tipo_usu){
                case 1:
                    $query = "UPDATE `usu_cpf` SET `nome_usu_cpf`='$nome',`email_usu_cpf`='$email',`senha_usu_cpf`='$senha' WHERE `id_usu_cpf` = '$id'";
                    break;
                case 2:
                    $status_conta_usu_cnpj = $this->status_conta_usu_cnpj;
                    $cnpj_usu_cnpj = $this->cnpj_usu_cnpj;
                    $query = "UPDATE `usu_cnpj` SET `nome_usu_cnpj`='$nome',`email_usu_cnpj`='$email',`senha_usu_cnpj`='$senha',`status_conta_usu_cnpj`='$status_conta_usu_cnpj',`cnpj_usu_cnpj`='$cnpj_usu_cnpj' WHERE `id_usu_cnpj` = '$id'";
                    break;
                case 3:
                    $query = "UPDATE `adm` SET `nome_adm`='$nome',`email_adm`='$email',`senha_adm`='$senha' WHERE `id_adm` = '$id'";
                    break;
                default:
                    return false;
            }

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }

        public function atribui_endereco($endereco){
            $id = $endereco->id;
            $pais = $endereco->pais;
            $uf = $endereco->uf;
            $cidade= $endereco->cidade;
            $bairro= $endereco->bairro;
            $logradouro= $endereco->logradouro;
            $complemento= $endereco->complemento;
            $cep= $endereco->cep;
            $this->endereco = new Endereco($id, $this->id, $pais, $uf, $cidade, $bairro, $logradouro, $complemento, $cep);
        }

        public function delete($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm
            $tipo_usu = $this->tipo_usu;
            $id = $this->id;

            switch($tipo_usu){
                case 1:
                    $query1 = "DELETE FROM `end_usu_cpf` WHERE WHERE `id_usu_cpf` = '$id'";
                    $query2 = "DELETE FROM `usu_cpf` WHERE WHERE `id_usu_cpf` = '$id'";
                    if($conexao->query($query1) === TRUE and $conexao->query($query2) === TRUE){
                        return true;
                    }else{
                        return false;
                    }
                case 2:
                    $query1 = "DELETE FROM `end_usu_cnpj` WHERE WHERE `id_usu_cnpj` = '$id'";
                    $query2 = "DELETE FROM `prod` WHERE WHERE `id_usu_cnpj` = '$id'";
                    $query3 = "DELETE FROM `pag` WHERE WHERE `id_usu_cnpj` = '$id'";
                    $query4 = "DELETE FROM `usu_cnpj` WHERE WHERE `id_usu_cnpj` = '$id'";
                    if($conexao->query($query1) === TRUE and $conexao->query($query2) === TRUE and $conexao->query($query3) === TRUE and $conexao->query($query4) === TRUE){
                        return true;
                    }else{
                        return false;
                    }
                case 3:
                    $query = "DELETE FROM `adm` WHERE WHERE `adm` = '$id'";
                    if($conexao->query($query) === TRUE){
                        return true;
                    }else{
                        return false;
                    }
                default:
                    return false;
            }
        }

        public function def_tipo_usu($conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj, 3 = adm

            $email = $this->email;
            $query1 = "SELECT * FROM `usu_cpf` WHERE email_usu_cpf = '$email'";
            $query2 = "SELECT * FROM `usu_cnpj` WHERE email_usu_cnpj = '$email'";
            $query3 = "SELECT * FROM `adm` WHERE email_adm = '$email'";
            $result = mysqli_query($conexao, $query1);
            $row = mysqli_num_rows($result);
            if($row == 1){
                $this->tipo_usu=1;
                echo "<p>Descobri que é o tipo de usuário é 1 na função def_tipo_usu</p>";
                return 1;
            }

            $result = mysqli_query($conexao, $query2);
            $row = mysqli_num_rows($result);
            if($row == 1){
                $this->tipo_usu=2;
                echo "<p>Descobri que é o tipo de usuário é 2 na função def_tipo_usu</p>";
                return 2;
            }

            $result = mysqli_query($conexao, $query3);
            $row = mysqli_num_rows($result);
            if($row == 1){
                $this->tipo_usu=3;
                echo "<p>Descobri que o tipo de usuário é 3 na função def_tipo_usu</p>";
                return 3;
            }
            echo "<p>Falha ao decidir o tipo de usuário na função def_tipo_usu</p>";
            return false;
        }
    }
?>