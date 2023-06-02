<?php
    # Classe referente ao endereço do cliente
    class Endereco{
        public $id;
        public $id_fk;
        public $logradouro;
        public $cep;
        public $cidade;
        public $bairro;
        public $uf;
        public $pais;
        public $complemento;
        
        public function __construct($id, $id_fk, $pais, $uf, $cidade, $bairro, $logradouro, $complemento, $cep){
            $this->logradouro = $logradouro;
            $this->bairro = $bairro;
            $this->uf = $uf;
            $this->cep = $cep;
            $this->pais = $pais;
            $this->complemento = $complemento;
            $this->cidade = $cidade;
            $this->id = $id;
            $this->id_fk = $id_fk;
        }

        public function cadastro($tipo_usu, $conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj
            $pais = $this->pais;
            $uf = $this->uf;
            $cidade = $this->cidade;
            $bairro = $this->bairro;
            $logradouro = $this->logradouro;
            $complemento = $this->complemento;
            $id_fk = $this->id_fk;
            $cep = $this->cep;

            

            switch($tipo_usu){
                case 1:
                    $query = "INSERT INTO `end_usu_cnjp`(`pais_end_usu_cnpj`, `uf_end_usu_cnpj`, `cidade_end_usu_cnpj`, `bairro_end_usu_cnpj`, `logradouro_end_usu_cnpj`, `complemento_end_usu_cnpj`, `cep_end_usu_cnpj`, `id_usu_cnpj`) VALUES ('$pais','$uf','$cidade','$bairro','$logradouro','$complemento', '$cep', '$id_fk')";
                    break;
                case 2:
                    $query = "INSERT INTO `end_usu_cpf`(`pais_end_usu_cpf`, `uf_end_usu_cpf`, `cidade_end_usu_cpf`, `bairro_end_usu_cpf`, `logradouro_end_usu_cpf`, `complemento_end_usu_cpf`, `cep_end_usu_cpf`, `id_usu_cpf`) VALUES ('$pais','$uf','$cidade','$bairro','$logradouro','$complemento', '$cep', '$id_fk')";
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
        
        public function updade($tipo_usu, $conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj
            $pais = $this->pais;
            $uf = $this->uf;
            $cidade = $this->cidade;
            $bairro = $this->bairro;
            $logradouro = $this->logradouro;
            $complemento = $this->complemento;
            $id_fk = $this->id_fk;
            $cep = $this->cep;

            switch($tipo_usu){
                case 1:
                    $query = "UPDATE `end_usu_cpf` SET `pais_end_usu_cpf`='$pais',`uf_end_usu_cpf`='$uf',`cidade_end_usu_cpf`='$cidade',`bairro_end_usu_cpf`='$bairro',`logradouro_end_usu_cpf`='$logradouro',`complemento_end_usu_cpf`='$complemento',`cep_end_usu_cpf`='$cep' WHERE `id_usu_cpf`='$id_fk'";
                    break;
                case 2:
                    $query = "UPDATE `end_usu_cnpj` SET `pais_end_usu_cnpj`='$pais',`uf_end_usu_cnpj`='$uf',`cidade_end_usu_cnpj`='$cidade',`bairro_end_usu_cnpj`='$bairro',`logradouro_end_usu_cnjp`='$logradouro',`complemento_end_usu_cnpj`='$complemento',`cep_end_usu_cnpj`='$cep' WHERE `id_usu_cnpj`='$id_fk'";
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

        public function pega_endereco_banco($tipo_usu, $conexao){
            # $tipo_usu: 1 = usu_cpf, 2 = usu_cnpj
            $id_fk = $this->id_fk;


            switch($tipo_usu){
                case 1:
                    $query = "SELECT * FROM `end_usu_cpf` WHERE id_usu_cpf = '$id_fk'";
                    break;
                case 2:
                    $query = "SELECT * FROM `end_usu_cnpj` WHERE id_usu_cnpj = '$id_fk'";
                    break;
                default:
                    return false;
            }

            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result); 
            $end_bd = mysqli_fetch_assoc($result);

            if($row == 1){
                if($tipo_usu == 1){
                    $this->__construct($end_bd["id_end_usu_cpf"], $end_bd["id_usu_cpf"], $end_bd["pais_end_usu_cpf"], $end_bd["uf_end_usu_cpf"], $end_bd["cidade_end_usu_cpf"], $end_bd["bairro_end_usu_cpf"], $end_bd["logradouro_end_usu_cpf"], $end_bd["complemento_end_usu_cpf"], $end_bd["cep_end_usu_cpf"]);
                }else{
                    $this->__construct($end_bd["id_end_usu_cnpj"], $end_bd["id_usu_cnpj"], $end_bd["pais_end_usu_cnpj"], $end_bd["uf_end_usu_cnpj"], $end_bd["cidade_end_usu_cnpj"], $end_bd["bairro_end_usu_cnpj"], $end_bd["logradouro_end_usu_cnpj"], $end_bd["complemento_end_usu_cnpj"], $end_bd["cep_end_usu_cnpj"]);
                }
                return true;
            }else{
                return false;
            }
        }
    }
?>