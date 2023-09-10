<?php
    Class Cliente{//Classe Cliente

        //atributos da classe
        public $pdo;
        public $clienteCPF;
        public $clienteNOME;
        public $clienteSENHA;
        public $adm;//0 para o cliente e 1 para adm

        //Criando conexão com o banco de dados
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

        //Método que vai inserir no banco de dados as informações do usuário
        public function inserir_dados_usuario($clienteCPF, $clienteNOME, $clienteSENHA, $adm){
            $this->clienteCPF = $clienteCPF;//Salvando as variaveis para a classe
            $this->clienteNOME = $clienteNOME;//Salvando as variaveis para a classe
            $this->clienteSENHA = $clienteCPF;//Salvando as variaveis para a classe
            $this->adm = $adm;//Salvando as variaveis para a classe
            //Antes de cadastrar, verificar se já existe um igual?
            $cmd = $this->pdo->prepare("SELECT clienteId FROM cliente WHERE clienteCpf = :c");//realiza atráves da classe o select no banco
            $cmd->bindValue(":c",$clienteCPF);//Puxa o parametro e salva nele
            $cmd->execute();//executa

            if($cmd->rowCount() > 0){//CPF já existe
                return false;//retorna falso
            }
            else{//CPF não existe
                $cmd = $this->pdo->prepare("INSERT INTO cliente ( clienteCpf, clienteNome, clienteSenha, adm) VALUES (:c, :n, :s, :a)");//Insert na tabela através da classe, onde o $This-> é para o atributo da classe
                $cmd->bindValue(":c",$clienteCPF);//Puxa o parametro e salva nele
                $cmd->bindValue(":n",$clienteNOME);//Puxa o parametro e salva nele
                $cmd->bindValue(":s",$clienteSENHA);//Puxa o parametro e salva nele
                $cmd->bindValue(":a",$adm);//Puxa o parametro e salva nele
                $cmd->execute();//Executa o insert
                return true;//Retorna true para se o insert foi realizado
            }
        }

        //Método que vai devolver uma de lista dos usuários do site
        public function exibir_dados_cliente(){
            $resultado = array();//Deixa a variavel vazia para não dar erro
            $cmd = $this->pdo->prepare("SELECT * FROM cliente ORDER BY clienteId");//Select realizado pela classe
            $cmd->execute();//Execute
            $resultado = $cmd->fetchAll(PDO::FETCH_ASSOC);//Salva o valor em uma matriz. o PDO::FETCH_ASSOC é para economizar código
            return $resultado;//Retorna a matriz
        }

        //Método para verificar senha do usuário
        public function verifica_login_usuario($clienteCPF, $clienteSENHA){

            $this->clienteCPF = $clienteCPF;//Salvando as variaveis para a classe
            $this->clienteSENHA = $clienteSENHA;//Salvando as variaveis para a classe

            $cmd = array();//Deixa a variavel vazia para não dar erro
            $cmd = $this->pdo->prepare("SELECT * FROM cliente WHERE clienteCpf = :c AND clienteSenha = :s");//Select para puxar se existe algum usuário com cpf e senha
            $cmd->bindValue(":c", $clienteCPF);//Puxa o parametro e salva nele
            $cmd->bindValue(":s", $clienteSENHA);//Puxa o parametro e salva nele
            $cmd->execute();//Executa o comando
            $resultado1 = $cmd->fetchAll(PDO::FETCH_ASSOC);//Salva o valor em uma matriz. o PDO::FETCH_ASSOC é para economizar código
            return $resultado1;//retorna como matriz, onde se não houver nenhuma linha, a matriz retornará vazia
        }
    }
?>