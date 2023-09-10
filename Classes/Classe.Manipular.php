<?php

    require_once 'Classe.Cliente.php';

    Class Manipular extends Cliente{

        private $clienteId;

        //Excluir dados
        public function excluir_dados($id){
            $this->id = $id;//O id não se altera.
            $cmd = $this->pdo->prepare("DELETE FROM cliente WHERE clienteId = :f");            
            $cmd->bindValue(":f", $this->id);//Puxa o parametro e salva nele
            $cmd->execute();
            return true;
        }
        //alterar dados
        public function alterar($id, $clienteCPF, $clienteNOME, $clienteSENHA, $adm){
            $this->clienteId = $id;
            $this->clienteCPF = $clienteCPF;
            $this->clienteNOME = $clienteNOME;
            $this->clienteSENHA = $clienteSENHA;
            $this->adm = $adm;
            $sql = $this->pdo->prepare("UPDATE cliente SET adm = :a, clienteCpf = :c, clienteNome = :n, clienteSenha = :s WHERE clienteId = :i");            
            $sql->bindValue(":a", $this->adm);//Puxa o parametro e salva nele
            $sql->bindValue(":c", $this->clienteCPF);//Puxa o parametro e salva nele
            $sql->bindValue(":n", $this->clienteNOME);//Puxa o parametro e salva nele
            $sql->bindValue(":s", $this->clienteSENHA);//Puxa o parametro e salva nele
            $sql->bindValue(":i", $this->clienteId);
            $sql->execute(); 
            return true;
        }
    }
?>