<?php
    
    require_once 'BD/config.php';
    require_once 'Classes/Classe.Cliente.php';

    session_start();

    if(!isset($_SESSION['cliente_ID']) && !isset($_SESSION['cliente_ADM'])){//Se não estiver alguém logado faça isso
        if(isset($_POST['registrar'])){//Se  o usuário apertar o botão de adicionar usuário

            $p = new Cliente("db_hp","localhost","root","11153025192Fd@");

                $cpf = $_POST['cpf'];
                $nome = $_POST['nome'];
                $senha = $_POST['senha'];
                $adm = 0;

                if($p->inserir_dados_usuario($cpf, $nome, $senha, $adm)){
                    echo "Usuário cadastrado com sucesso";
                }
                else{
                    echo "Usuário já cadastrado";
                }
        }
    }
    else{
        echo "<p>Usuário já está logado</p>";

    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h1>Registrar-se</h1>
        <form action="" method="post">
            <label for="cpf">CPF:</label><br>
            <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" maxlength="14" required/>
            <br><br>
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required/>
            <br><br>
            <label for="senha">Senha:</label><br>
            <input type="text" id="senha" name="senha" required/>
            <br><br>
            <input type="submit" value="Registrar-se" name="registrar">
        </form>
    <a href="index.php">Voltar</a>
</body>
</html>