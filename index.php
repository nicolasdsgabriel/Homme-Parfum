<?php
    require_once 'BD/config.php';
    require_once 'Classes/Classe.Produto.php';

    $p = new Produto("db_hp","localhost","root","11153025192Fd@");
    

   session_start();

    if(isset($_SESSION['cliente_ID']) && isset($_SESSION['cliente_ADM'])){//Se o usuário está salvo na sessão
        $cliente_adm = $_SESSION['cliente_ADM'];//Puxa o valor de 'cliente_ADM', onde se for 0 é usuário e 1 é adm
        if($cliente_adm == 1){//Se $_SESSION['cliente_ADM'] for igual a 1
            header('location:ADM'); }
    }

    //if(!isset($_SESSION['cliente_ID'])){//Verifica se o usuário não está logado, ou seja, se o id dele está salvo na sessão
        //$mensagem[] = 'Ninguém está conectado'; 
    //}


    if(isset($_POST['adicionar'])){
        if(isset($_SESSION['cliente_ID']) && isset($_SESSION['cliente_ADM'])){//Verifica se há alguém logado na sessão
            $cliente_cargo = $_SESSION['cliente_ADM'];//Salva o valor da sessão 'cliente_ADM' para que possa fazer a validação, onde 1 é para adm e 0 para cliente
            if(isset($_SESSION['cliente_ID']) && $cliente_cargo == 1){ //Se o usuário está logado, e é um adm
                header('location:ADM/index.php');
            }
            else if (isset($_SESSION['cliente_ID']) && $cliente_cargo == 0){
                header('location:carrinho.php');
            }
            else{
                echo "Erro com a sessão";
            }
        }
        else if(!isset($_SESSION['cliente_ID']) && !isset($_SESSION['cliente_ADM'])){
            header('location:login.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMME PARFUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">HOMME PARFUM</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php if(isset($_SESSION['cliente_ID'])){echo "<a class='nav-link' href='logout.php'>Deslogar</a>";}?>
                        </li>
                        <li class="nav-item">
                            <?php if(!isset($_SESSION['cliente_ID'])){echo "<a class='nav-link' href='login.php'>Entrar</a>";}?>
                        </li>
                        <li class="nav-item">
                            <?php if(!isset($_SESSION['cliente_ID'])){echo "<a class='nav-link' href='registrar.php'>Registrar-se</a>";}?>
                        </li>
                    </ul>
                </div>
                <a class="nav-link" href="carrinho.php"><img src="img/carrinho.png"></a>
            </div>
        </nav>
    </header>
    <?php
     if(isset($_SESSION['clienteNome'])){
     echo "<h3 class='desc'> Bem Vindo " . $_SESSION['clienteNome'] . "</h3>";
    }
    ?>
    <?php
            //Mensagem sobre ninguém estar logado
            if(isset($mensagem)){
                foreach($mensagem as $mensagem){//como é um vetor a mensagem, o foeach para pedir as informações
                   echo "<div class='mensagem' onclick='this.remove();'>".$mensagem."</div>";
                }
             }
    ?>
    <div class="container text-center">
        <div class="row">
            <!-- Produtos da loja -->
            <?php
                $dados = $p->exibirDadosProdutos();

                if (count($dados) > 0) {
                    foreach ($dados as $i => $produto) {
                        echo "<div class='col-lg-3 col-md-4 col-sm-6 mb-4'>";
                            echo "<div class='card card-fix-height' style='width: 18rem;''>";
                                echo "<img src='" . $produto['produtoImg'] . "' class='card-img-top'/>";
                                echo "<div class='card-body'>";
                                    echo "<h4 class='card-title'>" . $produto['produtoNome'] . "</h4>";
                                    echo "<h5 class='card-text'>" . $produto['produtoMarca'] . "</h5>";
                                    echo "<p class='card-text'>R$ " . $produto['produtoPreco'] . ",00</p>";
                                echo "</div>";
                                echo "<form action='carrinho.php' method='POST'>";
                                        echo "<input type='hidden' value='" . $produto['produtoImg'] . "' name='imagem_produto[$i]'>";
                                        echo "<input type='hidden' value='" . $produto['produtoNome'] . "' name='produto_nome[$i]'>";
                                        echo "<input type='hidden' value='" . $produto['produtoMarca'] . "' name='produto_marca[$i]'>";
                                        echo "<input type='hidden' value='" . $produto['produtoPreco'] . "' name='produto_preco[$i]'>";
                                        echo "<input type='submit' class='btn btn-warning' value='Adicionar ao Carrinho' name='adicionar[$i]_$i'>";
                                    echo "</form>";
                            echo "</div>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: #F5F5F5; 
        }
        .card-container {
            display: flex;
            justify-content: space-between; 
            margin-bottom: 20px;
        }

        .card {
            margin-top: 30px;
        }

        .card-fix-height {
            height: 100%;
        }
        .card-img-top{
            width: 286px;
            height: 401.47px;
        }
        .btn{
            width: 100%;
            margin-bottom: 2px;
            background-color: #DAA520;
        }
    </style>
</body>
</html>