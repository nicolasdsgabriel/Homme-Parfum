<?php
    
    require_once 'BD/config.php';
    require_once 'Classes/Classe.Cliente.php';
    require_once 'Classes/Classe.Produto.php';
    
    session_start(); 

    $requeri_classe = new Cliente("db_hp","localhost","root","11153025192Fd@"); 
   
    if(isset($_POST['logar'])){ 

        if(!isset($_SESSION['cliente_ID']) && !isset($_SESSION['cliente_ADM'])){ //Verifica-se se o usuário já está logado, caso não prossiga com o código

            $cpf = $_POST['cpf']; 
            $senha = $_POST['senha']; 

            $contador = 0 ; 
            $auxiliar = 0; 
            $j=0; 

            $resultado = $requeri_classe->verifica_login_usuario($cpf,$senha); //Puxa o método da classe cliente, em que este método será responsavel pelo select e retorna uma matriz.

            if(count($resultado) > 0){
                for ($i=0; $i < count($resultado) ; $i++) { 
                    foreach ($resultado[$i] as $key => $value) {
                        if($key == 'clienteId'){
                            $_SESSION['cliente_ID'] = $value;//Salvar o valor do vetor para a sessão, para que os outros arquivos usem a sessão
                            $contador++;

                        }
                        if($key == 'clienteNome'){
                            $_SESSION['clienteNome'] = $value;
                            $auxiliar++;
                        }
                        if($key == 'adm'){
                            $_SESSION['cliente_ADM'] = $value;
                            $auxiliar++;
                        }
                        if($contador != 0 && $auxiliar != 0){
                            $aviso = "Login realizado";//Salvando a mensagem na variavel aviso.
                            $j++;//Contador = 1, com isso sabemos que a mensagem foi declarada.
                        }
                    }
                }
            }
            else{

                echo "Usuario inexistente!";

            }
        }
        else{
            echo "Usuário já logado";
        }
    }
    if(isset($_SESSION['cliente_ID']) && isset($_SESSION['cliente_ADM'])){//Caso o usuário esteja logado, faça:
        header('location:index.php');//Redireciona para a página principal para todos os usuários(logados e deslogados), menos o adm
    }
    
    if(isset($aviso) && isset($_SESSION['cliente_ID']) && $j == 1){//Para mostrar na tela o aviso de que há alguem logado, onde a lógica é a seguinte: Se o aviso foi salvo, o usuário foi salvo na sessão e o contador é igual a 1, moste a mensagem. 
        echo $aviso;//Mensagem
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Página de Login </title>
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
                            <h2>Login de Usuário</h2>
                        </div>
                        <form action="" method="post">
                            <div class="card-text">
                                <label for="cpf">CPF:</label><br>
                                <input type="text" id="cpf" name="cpf" placeholder="XXX.XXX.XXX-XX" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}" maxlength="14" required/>
                                <br><br>
                            </div>
                            <div class="card-text">
                                <label for="senha">Senha:</label><br>
                                <input type="text" id="senha" name="senha" required/>
                                <br><br>
                            </div>
                                <input type="submit" class="btn btn-warning" value="Logar" name="logar">
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