<?php
    require_once '../BD/config.php';
    require_once '../Classes/Classe.Cliente.php';
    require_once '../Classes/Classe.Manipular.php';

    $sql = new Manipular("db_hp","localhost","root","11153025192Fd@");

    session_start();

    if(isset($_SESSION['cliente_ID'])){//Se estiver conectado o usuário
        $client_ADM = $_SESSION['cliente_ADM'];
            if($client_ADM == 1){//se for adm prossiga
                if(isset($_POST['cadastrar'])){
                    $valorid = $_SESSION['valorid'];
                    $cpf2 = $_POST['cpf'];
                    $nome2 = $_POST['nome'];
                    $senha2 = $_POST['senha'];
                    $adm2 = $_POST['adm'];
                    $alterar = $sql->alterar($valorid, $cpf2, $nome2, $senha2, $adm2);
                    if($alterar){
                        echo "Alterado com sucesso";
                    }
                    else{
                        echo "Erro ao alterar";
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
    <title>Atualizando Usuário</title>
    <style>
        body{
            background-color: whitesmoke;
        }
    </style>
</head>
<body>
    <h1>Atualizar Usuario</h1>
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
            <input type="submit" value="Atualizar" name="cadastrar">
        </form>
    <a href="index.php">Voltar</a>
</body>
<footer>
    <p>Editando o rodapé</p>
</footer>
</html>