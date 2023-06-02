<?php
    class Pag{
        public $id_pag;
        public $id_usu_cnpj;
        public $valor_pag;
        public $status_pag;
        public $vencimento_pag;

        public function __construct($id_pag, $id_usu_cnpj, $valor_pag, $status_pag, $vencimento_pag){
            $this->id_pag = $id_pag;
            $this->id_usu_cnpj = $id_usu_cnpj;
            $this->valor_pag = $valor_pag;
            $this->status_pag = $status_pag;
            $this->vencimento_pag = $vencimento_pag;
        }

        public function cadastro($conexao){
            $valor_pag = $this->valor_pag;
            $status_pag = $this->status_pag;
            $vencimento_pag = $this->vencimento_pag;
            $id_usu_cnpj = $this->id_usu_cnpj;
            
            $query = "INSERT INTO `pag`(`valor_pag`, `status_pag`, `vencimento_pag`, `id_usu_cnpj`) VALUES ('$valor_pag','$status_pag','$vencimento_pag','$id_usu_cnpj')";

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }

        public function updade($conexao){
            $id_pag = $this->id_pag;
            $valor_pag = $this->valor_pag;
            $status_pag = $this->status_pag;
            $vencimento_pag = $this->vencimento_pag;
            $id_usu_cnpj = $this->id_usu_cnpj;
            
            $query = "UPDATE `pag` SET `valor_pag`='$valor_pag',`status_pag`='$status_pag',`vencimento_pag`='$vencimento_pag',`id_usu_cnpj`='$id_usu_cnpj' WHERE `id_pag`='$id_pag'";

            if($conexao->query($query) === TRUE){
                return true;
            }else{
                return false;
            }
        }

        public function pega_pagamento_banco($conexao){
            $id_usu_cnpj = $this->id_usu_cnpj;
            $query = "SELECT * FROM `pag` WHERE id_usu_cnpj = '$id_usu_cnpj'";
            $result = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($result); 
            $pag_bd = mysqli_fetch_assoc($result);

            if($row == 1){
                $this->__construct($pag_bd["id_pag"], $pag_bd["id_usu_cnpj"], $pag_bd["valor_pag"], $pag_bd["status_pag"], $pag_bd["vencimento_pag"]);
                return true;
            }else{
                return false;
            }
        }
    }
?>