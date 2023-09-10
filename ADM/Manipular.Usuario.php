<?php
    require_once '../BD/config.php';
    require_once '../Classes/Classe.Cliente.php';
    require_once '../Classes/Classe.Manipular.php';

    $sql = new Manipular("db_hp","localhost","root","11153025192Fd@");

    session_start();

    if(isset($_SESSION['cliente_ID'])){//Se estiver conectado o usuário
        $client_ADM = $_SESSION['cliente_ADM'];
            if($client_ADM == 1){//se for adm prossiga
                if(isset($_POST['enviar'])){//se foi enviado a requisição
                    $contador = 0;//para ver se chegou no final da tabelas
                    $stop = 0;
                    $cpf = $_POST['cpf'];//pega o cof do formulário
                    $escolha = $_POST['escolha'];//pega a escola do formulário
                    $dados = $sql->exibir_dados_cliente();//puxa do banco o id do cpf que vai ser editado ou deletado
                    if(count($dados) > 0){
                        for ($i=0; $i < count($dados) ; $i++) { //Laço de repetição para podermos andar sobre os usuários, foi usado desta maneira, pois os dados vem em formato de matriz
                            echo "<br>";
                            foreach ($dados[$i] as $key => $valor) {
                                if($key == 'clienteId'){//Se chegou no campo do id faça
                                    if($dados[$i]['clienteCpf'] == $cpf){//Se o campo cpf for igual ao cpf do formulário faça
                                        $valorid = $dados[$i][$key];//variavel para salvar informação do id
                                        $_SESSION['valorid'] = $valorid;
                                        $cpfN = $dados[$i]['clienteCpf'];//Salvar a variavel do cpf
                                        $stop = 1;//informe para parar o laço de repetição
                                    }
                                    $contador++;//Adicione que foi percorrido mais uma linha
                                }
                            }
                            if($stop == 1){//caso puxe as informações corretas o laço é parado
                                break;
                            }
                        }
                        if(((count($dados)) == $contador) && !isset($cpfN)){//se o laço terminar e não for atribuido nenhum cpf, então não existe este cpf
                            echo "<br>Não existe este cpf<br>";
                        }
                    }
                    if(isset($cpfN) && isset($valorid)){//Se tiver algum valor para o as variaveis de controle, então faça
                        if($_SESSION['cliente_ID'] != $valorid){//se o id for o mesmo do adm que está editando, então não pare.
                            if($escolha == "Deletar"){//se o usuário escolheu excluir
                                $excluir = $sql->excluir_dados($valorid);
                                if($excluir){
                                    echo "Deletado com sucesso";
                                }
                                else{
                                    echo "Não foi possivel deletar o id";
                                }
                            }
                            else if($escolha == "Editar"){//Se for editar
                            header('location:altera.php');
                            }
                            else{//Se for nenhuma das duas, ou seja, erro
                                echo "erro com a escolha";
                            }
                        }
                        else{
                            echo "O usuário está tentando manipular o proprio usuário!";
                        }
                    }
                }
            }
            else{
                header('location:index.ph');
            }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manipular os dados de usuário</title>
    <style>
        body, form , footer{
            border: solid black 1px;
            padding: 10px;
            margin: 10px;
            background-color: whitesmoke;
        }
    </style>
</head>
<body>
    <form method="POST" action="">
    <br>
    <label for="cpf">CPF: </label>
    <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" maxlength="14" required/>
    <br><br>
    <label for="p">Alterar usuário</label>
    <input type="radio" name="escolha" value="Editar">
    <br><br>
    <label for="d">Deletar usuário</label>
    <input type="radio" name="escolha" value="Deletar" checked>
    <br><br>
    <input type="submit" name="enviar" value=" ENVIAR ">
    <br><br>
    </form>
    <a href="index.php">Voltar</a>
</body>
<footer>
    <p>rodapé</p>
</footer>
</html>