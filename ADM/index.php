<?php
    //Página inicial do site, principal para qualquer usuário
    require_once '../BD/config.php';
    require_once '../Classes/Classe.Produto.php';//Puxa a classe Cliente

    session_start();//Para puxar se o usuario está é um adm

    if(isset($_SESSION['cliente_ID']) && isset($_SESSION['cliente_ADM'])){
        $cliente_adm = $_SESSION['cliente_ADM'];
        if($cliente_adm != 1){
            header('location:../');
            $mensagem[] = "Bem Vindo de Volta Adiministrador"; // vai para a pasta adm caso usuário seja adm
        }
    }

    if(!isset($_SESSION['cliente_ID'])){
        $mensagem[] = 'Ninguém está conectado'; // Mensagem que aparecerá na tela caso alguém não esteja conectado
        header('location:../login.php');
    }

    //Verificação de login
    if(isset($_POST['adicionar'])){
        if(!isset($_SESSION['cliente_ID']) && $_SESSION['cliente_ADM'] == 0){
            //Caso não esteja logado e tenha apertado o botão de adicionar, o usuário será direcionado para a tela de login 
            header('location:login.php');
        }
        else if(isset($_SESSION['cliente_ID']) && $_SESSION['cliente_ADM'] == 1){
            //ir para a pasta adm, pois é administrador o usuário;
            header('location:../carrinho');
        }
        else{
            //adicionar a tabela carrinho
        
        }
    }

    //conectar a classe
    $p = new Produto("db_hp","localhost","root","11153025192Fd@"); 

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOMME PARFUM</title>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="index.php"> HOMME PARFUM |</a>
            <a href="../logout.php"> Deslogar |</a>
            <a href="Novo.Usuario.php"> Adicionar Novo Usuário |</a>
            <a href="Manipular.Usuario.php"> Manipular Usuários |</a>
            <a href="Listar.Usuario.php"> Listar Usuários |</a>
            <a href="../carrinho.php"> Carrinho</a>
        </div>
    </header>
    <?php
     if(isset($_SESSION['clienteNome'])){
     echo "<h3 class='desc'> Bem Vindo " . $_SESSION['clienteNome'] . "</h3>";
    }
    ?> <!-- MENSEAGEM DE BOAS VINDAS POIS O USUÁRIO NÃO ESTÁ LOGADO -->
    <?php
            //Mensagem sobre ninguém estar logado
            if(isset($mensagem)){
                foreach($mensagem as $mensagem){
                   echo "<div class='mensagem' onclick='this.remove();'>".$mensagem."</div>";
                }
             }
    ?>
    <div class="">
        <!-- Produtos da loja -->
        <?php
            $dados = $p->exibirDadosProdutos();

            if (count($dados) > 0) {
                echo "<form action='../carrinho.php' method='POST'>";
                for ($i = 0; $i < count($dados); $i++) {
                    echo "<div class='tabela'>";
                    foreach ($dados[$i] as $key => $valor) {
                        if ($key == 'produtoImg') {
                            echo "<img src='../" . $valor . "'/>";
                            echo "<input type='hidden' value='" . $valor . "' name='imagem_produto[$i]'>";
                        }
                        if ($key == 'produtoNome') {
                            echo "<h4 class='desc'>" . $valor . "</h4>";
                            echo "<input type='hidden' value='" . $valor . "' name='produto_nome[$i]'>";
                        }
                        if ($key == 'produtoMarca') {
                            echo "<h4 class='desc'>" . $valor . "</h4>";
                            echo "<input type='hidden' value='" . $valor . "' name='produto_marca[$i]'>";
                        }
                        if ($key == 'produtoPreco') {
                            echo "<h5 class='desc'>" . $valor . "</h5>";
                            echo "<input type='hidden' value='" . $valor . "' name='produto_preco[$i]'>";
                        }
                        if ($key == 'produtoTipo') {
                            echo "<h6 class='desc'>" . $valor . "</h6>";
                            echo "<input type='hidden' value='" . $valor . "' name='produto_tipo[$i]'>";
                        }
                    }
                    echo "<input type='submit' value='Adicionar ao Carrinho' name='adicionar[$i]_$i'>";
                    echo "</div>";
                }
                echo "</form>";
            }
       ?>
    </div>
    <footer>
        <p>Rodapé</p>
        <p>Por Nicolas e Weslly</p>
    </footer>
</body>
</html>