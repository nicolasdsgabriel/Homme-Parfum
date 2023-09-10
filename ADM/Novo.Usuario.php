<?php
    require_once '../BD/config.php';
    require_once '../Classes/Classe.Cliente.php';//Puxa a classe Cliente

    session_start();//Para puxar se o usuario é um adm

    $cliente_id = $_SESSION['cliente_ID'];
    $cliente_cargo = $_SESSION['cliente_ADM'];

    if(isset($cliente_cargo) && $cliente_cargo == 1){
        $mensagem[] = "Bem Vindo de Volta Adiministrador"; // Confirmação de que é um adm
    }

    if(!isset($cliente_id)){
        $mensagem[] = 'Ninguém está conectado'; // Mensagem que aparecerá na tela caso alguém não esteja conectado
        header('location:../login.php');
    }

    //Verificação de login
    if(isset($_POST['cadastrar'])){
        if(!isset($cliente_id) && $cliente_cargo == 0){
            //Caso não esteja logado e tenha apertado o botão de cadastrar, o usuário será direcionado para a tela de login
            header('location:../login.php');
        }
        else if(isset($cliente_id) && $cliente_cargo == 1){
            //Realiza o cadastro
            
                //conectando a classe cliente
                $p = new Cliente("db_hp","localhost","root","11153025192Fd@");

                $cpf = $_POST['cpf'];
                $nome = $_POST['nome'];
                $senha = $_POST['senha'];
                $adm = $_POST['adm'];

                if($p->inserir_dados_usuario($cpf, $nome, $senha, $adm)){
                    echo "Usuário cadastrado com sucesso";
                }
                else{
                    echo "Usuário já cadastrado";
                }

        }
        else{
            //Usuário não é adm
            header("location:../login.php");
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Novo Usuário</title>
</head>
<body>
    <h1>Criar Novo Usuario</h1>
        <form action="" method="post">
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" maxlength="14" required/>
            <br><br>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" />
            <br><br>
            <label for="senha">Senha:</label><br>
            <input type="text" id="senha" name="senha" />
            <br><br>
            <label for="adm">Adm? (1) para sim e (0) para não</label>
            <input type="number" id="adm" name="adm" placeholder="0 ou 1" maxlength="1" required/>
            <br><br>
            <input type="submit" value="Cadastrar novo usuario" name="cadastrar">
        </form>
    <a href="index.php">Voltar</a>
</body>
<footer>
    <p>Editando o rodapé</p>
</footer>
</html>