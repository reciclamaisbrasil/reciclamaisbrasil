<?php
    class Prod{
        public $id_prod;
        public $nome_prod;
        public $valor_prod;
        public $id_usu_cnpj;

        public function __construct($id_prod, $nome_prod, $valor_prod, $id_usu_cnpj){
            $this->id_prod = $id_prod;
            $this->nome_prod = $nome_prod;
            $this->valor_prod = $valor_prod;
            $this->id_usu_cnpj = $id_usu_cnpj;
        }

        public function cadastro($conexao){
            $nome_prod = $this->nome_prod;
            $valor_prod = $this->valor_prod;
            $id_usu_cnpj = $this->id_usu_cnpj;
            
            $query = "INSERT INTO `prod`(`nome_prod`, `valor_prod`, `id_usu_cnpj`) VALUES ('$nome_prod','$valor_prod','$id_usu_cnpj')";

            if($conexao->query($query) === TRUE){
                $result = mysqli_fetch_assoc(mysqli_query($conexao, $query));
                $this->__construct($result["id_prod"], $result["nome_prod"], $result["valor_prod"], $result["id_usu_cnpj"]);
                return true;
            }else{
                return false;
            }
        }

        public function update($conexao){
            $nome_prod = $this->nome_prod;
            $valor_prod = $this->valor_prod;
            $id_prod = $this->id_prod;
            
            $query = "UPDATE `prod` SET `nome_prod`='$nome_prod',`valor_prod`='$valor_prod' WHERE `id_prod`='$id_prod'";

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }

        public function delete($conexao){
            $id_prod = $this->id_prod;
            $query = "DELETE FROM `prod` WHERE `id_prod`='$id_prod'";

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }
    }
?>