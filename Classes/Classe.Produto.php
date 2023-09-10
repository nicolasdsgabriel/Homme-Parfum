<?php

    //Responsável pela classe produto

    class Produto{//Cria-se a classe produto

        private $pdo;//declaração de variavel interna
        //Estabelece conexão com o banco de dados, além de ser o construtor da classe
        public function __construct($dbname, $host, $user, $senha){
            try {
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
            }
            catch(PDOException $e){
                echo "Erro com o banco de dados: " . $e->getMessage();
                exit();
            }
            catch(Exception $e){
                echo "Erro generico: " . $e->getMessage();
                exit();
            }
        }
        //Método para exibir os dados da tabela produtos
        public function exibirDadosProdutos(){
            $resultado = array();//para retornar um vetor vazio, caso não haja produtos cadastrados, também para não dar erro
            $cmd = $this->pdo->prepare("SELECT * FROM produto ORDER BY produtoId");//Comando sql que o método realizará
            $cmd->execute();//Executa o comando
            $resultado = $cmd->fetchAll(PDO::FETCH_ASSOC);//Salva os dados em uma matriz 'resultado', onde 'resultado[Será as linhas da tabela][Os dados da linhas]'
            return $resultado;//Retorna a matriz.
        }
    }
?>