<?php
    require_once '../BD/config.php'; //Puxa conexão com o banco de dados, para caso o site queira fazer um requerimento sem as classes.
    require_once '../Classes/Classe.Produto.php'; //Classe Produto
    require_once '../Classes/Classe.Cliente.php'; //Puxa os métodos da classa clientes

    session_start(); //Puxa a sessão. Para fazer verificação de login

    if(isset($_SESSION['cliente_ID']) && isset($_SESSION['cliente_ADM'])){//Verifica se o usuario está logado
        if($_SESSION['cliente_ADM'] == 1){//Verifica se o usuário é um adm
            $mensagem[] = "Bem Vindo de Volta Adiministrador"; // Confirmação de que é um adm
            $validacao = true; //Variavel para validação no html
        }
        else{ //Redireciona o usuário para a página de cliente, caso não seja adm
            header('location:../');
        }
    }
    else{
        //Redireciona o usuário para a página de login.php
        header('location:../login.php');
    }

    $listar = new Cliente("db_hp","localhost","root","11153025192Fd@"); //Conecta com a classe Clientes

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Usuários</title>
    <style>
        table, tr, th, td{
            border-collapse: collapse;
            border: solid black 1px;
        }
    </style>
</head>
<body>
    <?php
        //Mensagem Para o adiministrador, podendo ele remover
        if(isset($mensagem)){
            foreach($mensagem as $mensagem){
               echo "<div class='mensagem' onclick='this.remove();'>".$mensagem."</div>";
            }
         }
    ?>
    <table>
        <thead>
        <tr>
            <th>
                ID do usuario
            </th>
            <th>
                CPF do usuario
            </th>
            <th>
                Nome do usuario
            </th>
            <th>
                Senha do usuario
            </th>
            <th>
                ADM
            </th>
        </tr>
        </thead>
        <tbody>
        <?php
            $listarDADOS = $listar->exibir_dados_cliente();//Vai pedir o método da classe
            if(count($listarDADOS) > 0) { //IF para verificar se existe clientes
            for ($i=0; $i < count($listarDADOS) ; $i++) { //Laço de repetição para podermos andar sobre os usuários, foi usado desta maneira, pois os dados vem em formato de matriz
                echo "<tr>";
                foreach ($listarDADOS[$i] as $key => $valor) {
                    echo "<td>".$valor."</td>";
                }
                echo "</tr>";
            }
            /*
            //Sintaxe para verificar como é retornado a matriz do banco de dados
            echo "<pre>";
            var_dump($listarDADOS); Capaz de visualizar os comandos
            echo "</pre>";
                        */
            }
        ?>
        </tbody>
    </table>
    <a href="index.php">Voltar</a>
</body>
<footer>
    rodapé
</footer>
</html>