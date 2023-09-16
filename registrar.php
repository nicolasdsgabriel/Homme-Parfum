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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">HOMME PARFUM</a>
            </div>
        </nav>
    </header>
    <div class="container text-center">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-auto">
                <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-body">
                        <div class="card-title">
                            <h2>CADASTRE-SE</h2>
                        </div>
                        <form action="" method="post">
                            <div class="card-text">    
                                <label for="cpf">CPF:</label><br>
                                <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" maxlength="14" required/>
                                <br><br>
                            </div>
                            <div class="card-text">
                                <label for="nome">Nome:</label><br>
                                <input type="text" id="nome" name="nome" required/>
                                <br><br>
                            </div>
                            <div class="card-text">
                                <label for="senha">Senha:</label><br>
                                <input type="text" id="senha" name="senha" required/>
                                <br><br>
                            </div>
                                <input type="submit" class="btn btn-warning" value="Registrar-se" name="registrar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        body{
            background-image: url(img/bg-img.jpg);
        }
        .btn{
            background-color: #DAA520;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>
</html>